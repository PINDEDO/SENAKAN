<x-app-layout>
    <div class="mb-8">
        <h1 class="text-2xl font-bold text-sena-gray900">Bienvenido, {{ Auth::user()->name }}</h1>
        <div class="flex items-center space-x-2 mt-1">
            <span class="text-sm text-sena-gray400">{{ now()->format('d M, Y') }}</span>
            <span class="text-xs font-bold uppercase py-0.5 px-2 bg-sena-navyLight text-sena-navy rounded-full">
                {{ auth()->user()->role }}
            </span>
        </div>
    </div>

    <!-- Metric Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Tareas -->
        <div class="bg-white rounded-lg shadow-card p-5 border-l-4 border-sena-navy">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-sena-gray400 uppercase tracking-widest">Total Tareas</p>
                    <h3 class="text-3xl font-bold text-sena-gray900 mt-1">{{ $metrics['total_tasks'] }}</h3>
                </div>
                <div class="p-2 bg-sena-navyLight rounded-lg text-sena-navy">
                    <i class="bi bi-list-task text-xl"></i>
                </div>
            </div>
            <p class="text-[11px] text-sena-gray400 mt-4">Gestión institucional activa</p>
        </div>

        <!-- Proyectos -->
        <div class="bg-white rounded-lg shadow-card p-5 border-l-4 border-blue-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-sena-gray400 uppercase tracking-widest">Proyectos</p>
                    <h3 class="text-3xl font-bold text-sena-gray900 mt-1">{{ $metrics['total_projects'] }}</h3>
                </div>
                <div class="p-2 bg-blue-50 rounded-lg text-blue-500">
                    <i class="bi bi-folder2 text-xl"></i>
                </div>
            </div>
            <p class="text-[11px] text-sena-gray400 mt-4">Centros de formación</p>
        </div>

        <!-- Vencidas -->
        <div class="bg-white rounded-lg shadow-card p-5 border-l-4 border-red-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-sena-gray400 uppercase tracking-widest">Vencidas</p>
                    <h3 class="text-3xl font-bold text-red-600 mt-1">{{ $metrics['overdue_tasks'] }}</h3>
                </div>
                <div class="p-2 bg-red-50 rounded-lg text-red-500">
                    <i class="bi bi-exclamation-triangle text-xl"></i>
                </div>
            </div>
            <p class="text-[11px] text-red-400 mt-4 font-medium flex items-center">
                <i class="bi bi-alarm mr-1"></i> Requiere atención
            </p>
        </div>

        <!-- Completadas -->
        <div class="bg-white rounded-lg shadow-card p-5 border-l-4 border-sena-green">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-sena-gray400 uppercase tracking-widest">Completadas</p>
                    <h3 class="text-3xl font-bold text-sena-green mt-1">{{ $metrics['completed_tasks'] }}</h3>
                </div>
                <div class="p-2 bg-sena-greenLight rounded-lg text-sena-green">
                    <i class="bi bi-check2-circle text-xl"></i>
                </div>
            </div>
            <p class="text-[11px] text-sena-green mt-4 font-medium flex items-center">
                <i class="bi bi-patch-check mr-1"></i> Cumplimiento real
            </p>
        </div>
    </div>

    <!-- Main Content Grid (64% / 36%) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Mis Tareas Pendientes -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-card overflow-hidden h-full flex flex-col">
                <div class="flex-1 overflow-y-auto custom-scrollbar bg-white">
                    @forelse($recent_tasks as $task)
                        <div class="p-4 border-b border-sena-gray50 last:border-0 hover:bg-sena-gray50 transition-colors cursor-pointer group">
                            <div class="flex justify-between items-start mb-2">
                                <div class="flex items-center space-x-3">
                                    <span class="w-2.5 h-2.5 rounded-full {{ $task->status === 'done' ? 'bg-sena-green' : ($task->priority === 'high' ? 'bg-red-500' : 'bg-sena-navy') }} shadow-sm"></span>
                                    <h4 class="text-sm font-semibold text-sena-gray700 group-hover:text-sena-navy transition-colors">
                                        {{ $task->title }}
                                    </h4>
                                </div>
                                @if($task->due_date && $task->status !== 'done')
                                    <span class="text-[10px] font-bold {{ \Carbon\Carbon::parse($task->due_date)->isPast() ? 'text-red-500 bg-red-50' : 'text-sena-gray400 bg-sena-gray50' }} px-2 py-0.5 rounded uppercase">
                                        {{ \Carbon\Carbon::parse($task->due_date)->format('d M') }}
                                    </span>
                                @endif
                            </div>
                            <div class="flex items-center justify-between ml-5.5">
                                <div class="flex items-center space-x-4">
                                    <div class="flex items-center text-xs text-sena-gray400">
                                        <i class="bi bi-folder2-open mr-1.5 text-xs"></i>
                                        <span>{{ $task->project->name }}</span>
                                    </div>
                                    <div class="flex items-center text-xs text-sena-gray400">
                                        <i class="bi bi-columns-gap mr-1.5 text-xs"></i>
                                        <span class="font-medium">{{ ucfirst($task->status) }}</span>
                                    </div>
                                </div>
                                <div class="flex -space-x-2">
                                    @if($task->assignee)
                                        <img src="{{ $task->assignee->avatar_url }}" class="w-6 h-6 rounded-full border-2 border-white" title="{{ $task->assignee->name }}">
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-16 text-center">
                            <div class="inline-flex items-center justify-center w-20 h-20 bg-sena-gray50 rounded-full mb-6">
                                <i class="bi bi-emoji-smile text-4xl text-sena-gray200"></i>
                            </div>
                            <h4 class="text-sena-gray700 font-bold text-lg">¡Todo al día!</h4>
                            <p class="text-sm text-sena-gray400 max-w-xs mx-auto mt-2">No hay actividad reciente para mostrar.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>

        <!-- Proyectos Activos -->
        <div class="lg:col-span-1">
            <div class="bg-white rounded-lg shadow-card overflow-hidden h-full">
                <div class="px-6 py-4 border-b border-sena-gray100 bg-white sticky top-0 z-10">
                    <h3 class="font-bold text-sena-gray900">Proyectos Activos</h3>
                </div>
                <div class="p-6 space-y-8">
                    @forelse($active_projects as $project)
                        <div class="group cursor-pointer" onclick="window.location.href='{{ route('board.index') }}?project_id={{ $project->id }}'">
                            <div class="flex justify-between items-start mb-3">
                                <div>
                                    <h4 class="text-sm font-bold text-sena-gray900 group-hover:text-sena-green transition-colors">{{ $project->name }}</h4>
                                    <p class="text-[10px] uppercase font-bold text-sena-gray400 tracking-widest mt-0.5">Ficha: {{ $project->code }}</p>
                                </div>
                                @php
                                    $percentage = $project->tasks_count > 0 ? round(($project->completed_tasks_count / $project->tasks_count) * 100) : 0;
                                @endphp
                                <span class="text-xs font-bold text-sena-green bg-sena-greenLight px-2 py-0.5 rounded">{{ $percentage }}%</span>
                            </div>
                            <div class="w-full bg-sena-gray100 rounded-full h-2 overflow-hidden">
                                <div class="bg-gradient-to-r from-sena-green to-green-400 h-full rounded-full transition-all duration-1000 ease-out shadow-sm" style="width: {{ $percentage }}%"></div>
                            </div>
                            <div class="flex justify-between mt-2">
                                <span class="text-[10px] text-sena-gray400 font-medium">{{ $project->completed_tasks_count }} de {{ $project->tasks_count }} completadas</span>
                                <span class="text-[10px] text-sena-navy font-bold group-hover:underline">Detalles →</span>
                            </div>
                        </div>
                    @empty
                        <div class="py-10 text-center">
                            <p class="text-xs text-sena-gray400">No hay proyectos activos.</p>
                        </div>
                    @endforelse

                    <a href="{{ route('projects.index') }}" class="block w-full text-center bg-sena-gray50 text-sena-navy text-xs font-bold py-3 rounded-lg hover:bg-sena-navyLight transition-colors mt-4">
                        Ver todos los proyectos institucionales
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Custom Scrollbar Style -->
    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 5px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #fdfdfd;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #E8ECEF;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #D1D8DF;
        }
    </style>
</x-app-layout>
