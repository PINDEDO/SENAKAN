<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl text-sena-gray900">Calendario de Actividades</h2>
            <div class="flex items-center space-x-4">
                <!-- Navigation -->
                <div class="flex items-center space-x-2 bg-sena-gray50 p-1 rounded-lg border border-sena-gray100">
                    @php
                        $prevMonth = $startOfMonth->copy()->subMonth();
                        $nextMonth = $startOfMonth->copy()->addMonth();
                    @endphp
                    <a href="{{ route('calendar.index', ['month' => $prevMonth->month, 'year' => $prevMonth->year]) }}" class="p-1.5 hover:bg-white hover:shadow-sm rounded-md transition-all text-sena-gray400 hover:text-sena-navy">
                        <i class="bi bi-chevron-left"></i>
                    </a>
                    
                    <!-- Date Picker Dropdown -->
                    <div class="relative group h-full">
                        <button onclick="toggleDatePicker()" class="px-4 py-1.5 bg-white shadow-sm border border-sena-gray100 rounded-md text-xs font-bold text-sena-navy uppercase flex items-center hover:border-sena-green transition-all">
                            <i class="bi bi-calendar-event mr-2 text-sena-green"></i>
                            {{ $startOfMonth->translatedFormat('F Y') }}
                            <i class="bi bi-chevron-down ml-2 text-[10px]"></i>
                        </button>
                        
                        <div id="datePickerDropdown" class="hidden absolute top-full left-1/2 -translate-x-1/2 mt-2 w-64 bg-white rounded-lg shadow-xl border border-sena-gray100 z-50 p-4 animate-in fade-in slide-in-from-top-2 duration-200">
                            <form action="{{ route('calendar.index') }}" method="GET" class="space-y-4 text-left">
                                <div>
                                    <label class="block text-[10px] font-bold text-sena-gray400 uppercase mb-2 tracking-widest">Seleccionar Año</label>
                                    <select name="year" class="w-full border-sena-gray200 rounded-md text-sm focus:border-sena-green focus:ring-sena-greenLight">
                                        @for($y = date('Y') - 5; $y <= date('Y') + 5; $y++)
                                            <option value="{{ $y }}" {{ $y == $startOfMonth->year ? 'selected' : '' }}>{{ $y }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div>
                                    <label class="block text-[10px] font-bold text-sena-gray400 uppercase mb-2 tracking-widest">Seleccionar Mes</label>
                                    <select name="month" class="w-full border-sena-gray200 rounded-md text-sm focus:border-sena-green focus:ring-sena-greenLight">
                                        @foreach(range(1, 12) as $m)
                                            <option value="{{ $m }}" {{ $m == $startOfMonth->month ? 'selected' : '' }}>
                                                {{ ucfirst(\Carbon\Carbon::create()->month($m)->translatedFormat('F')) }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="w-full bg-sena-navy text-white text-xs font-bold py-2 rounded-md hover:bg-sena-green transition-all uppercase tracking-wider">
                                    Filtrar Fecha
                                </button>
                            </form>
                        </div>
                    </div>

                    <a href="{{ route('calendar.index', ['month' => $nextMonth->month, 'year' => $nextMonth->year]) }}" class="p-1.5 hover:bg-white hover:shadow-sm rounded-md transition-all text-sena-gray400 hover:text-sena-navy">
                        <i class="bi bi-chevron-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </x-slot>

    <div class="bg-white rounded-lg shadow-card overflow-hidden">
        <!-- Header de días -->
        <div class="grid grid-cols-7 border-b border-sena-gray100 bg-sena-gray50/30">
            @foreach(['Dom', 'Lun', 'Mar', 'Mie', 'Jue', 'Vie', 'Sab'] as $day)
                <div class="py-3 text-center text-[10px] font-bold uppercase text-sena-gray400 tracking-widest border-r border-sena-gray100 last:border-0">
                    {{ $day }}
                </div>
            @endforeach
        </div>

        <!-- Días del calendario -->
        <div class="grid grid-cols-7 auto-rows-[120px]">
            @php
                $currentDate = $startOfCalendar->copy();
            @endphp
            @while($currentDate <= $endOfCalendar)
                @php
                    $dateString = $currentDate->format('Y-m-d');
                    $isToday = $currentDate->isToday();
                    $isDifferentMonth = $currentDate->month !== $startOfMonth->month;
                    $dayTasks = $tasks[$dateString] ?? collect();
                @endphp
                
                <div class="border-r border-b border-sena-gray100 p-2 transition-colors hover:bg-sena-gray50/50 group last:border-r-0
                    {{ $isDifferentMonth ? 'bg-sena-gray50/20' : '' }}
                    {{ $isToday ? 'bg-sena-greenLight/20 ring-1 ring-inset ring-sena-green/10' : '' }}">
                    
                    <div class="flex justify-between items-start mb-1">
                        <span class="text-xs font-bold {{ $isToday ? 'bg-sena-green text-white w-6 h-6 flex items-center justify-center rounded-full' : ($isDifferentMonth ? 'text-sena-gray200' : 'text-sena-gray900') }}">
                            {{ $currentDate->day }}
                        </span>
                        @if($dayTasks->count() > 0)
                            <span class="text-[9px] font-bold text-sena-green bg-sena-greenLight px-1.5 py-0.5 rounded-full">
                                {{ $dayTasks->count() }}
                            </span>
                        @endif
                    </div>

                    <div class="space-y-1 overflow-y-auto max-h-[85px] custom-scrollbar">
                        @foreach($dayTasks as $task)
                            <div class="px-1.5 py-0.5 rounded text-[9px] font-medium border border-l-2 shadow-sm truncate
                                {{ $task->priority === 'high' ? 'bg-red-50 border-red-100 border-l-red-500 text-red-700' : ($task->priority === 'medium' ? 'bg-orange-50 border-orange-100 border-l-orange-500 text-orange-700' : 'bg-blue-50 border-blue-100 border-l-blue-500 text-blue-700') }}"
                                title="{{ $task->title }}">
                                {{ $task->title }}
                            </div>
                        @endforeach
                    </div>
                </div>
                
                @php $currentDate->addDay(); @endphp
            @endwhile
        </div>
    </div>

    <script>
        function toggleDatePicker() {
            const dropdown = document.getElementById('datePickerDropdown');
            dropdown.classList.toggle('hidden');
        }

        // Clic fuera para cerrar
        window.addEventListener('click', function(e) {
            const dropdown = document.getElementById('datePickerDropdown');
            const button = dropdown.previousElementSibling;
            if (!dropdown.contains(e.target) && !button.contains(e.target)) {
                dropdown.classList.add('hidden');
            }
        });
    </script>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 3px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: transparent;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #D1D8DF;
            border-radius: 10px;
        }
    </style>
</x-app-layout>
