<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <div class="flex items-center space-x-4">
                <h2 class="font-bold text-xl text-sena-gray900">Tablero Kanban</h2>
                @if($projects->count() > 0)
                <select onchange="window.location.href='?project_id=' + this.value" class="border-sena-gray200 rounded-md text-sm py-1.5 focus:border-sena-green outline-none bg-white shadow-sm border">
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}" {{ $currentProject && $currentProject->id == $project->id ? 'selected' : '' }}>
                            {{ $project->name }} ({{ $project->code }})
                        </option>
                    @endforeach
                </select>
                @endif
            </div>
            @if($currentProject)
            <button onclick="document.getElementById('modal-task-create').classList.remove('hidden')" class="bg-sena-green text-white px-4 py-2 rounded-md font-bold text-sm flex items-center hover:bg-sena-greenHover transition-all shadow-sm">
                <i class="bi bi-plus-lg mr-2"></i> Nueva Tarea
            </button>
            @endif
        </div>
    </x-slot>

    @if(session('success'))
        <div class="mb-4 p-3 bg-sena-greenLight border-l-4 border-sena-green text-sena-greenHover font-bold text-xs rounded shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    @if(!$currentProject)
        <div class="bg-white p-12 rounded-lg shadow-card text-center">
             <i class="bi bi-kanban text-5xl text-sena-gray100 mb-4 block"></i>
             <h3 class="text-lg font-bold text-sena-gray700">Selecciona un proyecto</h3>
             <p class="text-sm text-sena-gray400 mt-2">Para ver el tablero Kanban, primero debes seleccionar o crear un proyecto.</p>
             <a href="{{ route('projects.index') }}" class="mt-6 inline-block bg-sena-navy text-white px-6 py-2 rounded-md font-bold text-sm">Ir a Proyectos</a>
        </div>
    @else
        <div class="flex space-x-6 overflow-x-auto pb-4 custom-scrollbar h-[calc(100vh-180px)]">
            @foreach(['pending' => 'Pendiente', 'progress' => 'En Proceso', 'done' => 'Finalizado'] as $status => $label)
                <div class="flex-shrink-0 w-80 flex flex-col h-full">
                    <div class="px-4 py-3 rounded-t-lg flex justify-between items-center border-b {{ $status === 'pending' ? 'bg-sena-gray100 border-sena-gray200' : ($status === 'progress' ? 'bg-blue-50 border-blue-100' : 'bg-sena-greenLight border-sena-green/10') }}">
                        <h3 class="text-sm font-bold uppercase tracking-widest flex items-center {{ $status === 'pending' ? 'text-sena-gray700' : ($status === 'progress' ? 'text-blue-700' : 'text-sena-green') }}">
                            @if($status === 'progress')
                                <span class="w-2 h-2 rounded-full bg-blue-500 mr-2 animate-pulse"></span>
                            @elseif($status === 'done')
                                <i class="bi bi-check-all mr-2 text-lg"></i>
                            @else
                                <span class="w-2 h-2 rounded-full bg-sena-gray400 mr-2"></span>
                            @endif
                            {{ $label }}
                        </h3>
                        <span class="text-[10px] font-bold bg-white px-2 py-0.5 rounded-full shadow-sm {{ $status === 'pending' ? 'text-sena-gray400' : ($status === 'progress' ? 'text-blue-500' : 'text-sena-green') }}">
                            {{ $tasks[$status]->count() }}
                        </span>
                    </div>
                    <div id="column-{{ $status }}" data-status="{{ $status }}" class="flex-1 p-3 rounded-b-lg space-y-3 overflow-y-auto kanban-column {{ $status === 'pending' ? 'bg-sena-gray50/50' : ($status === 'progress' ? 'bg-blue-50/20' : 'bg-sena-greenLight/10') }}">
                        @foreach($tasks[$status] as $task)
                            <div data-id="{{ $task->id }}" class="bg-white p-4 rounded-lg shadow-card border border-transparent hover:border-sena-green transition-all cursor-grab active:cursor-grabbing group {{ $status === 'done' ? 'opacity-70 line-through text-sena-gray400' : '' }}">
                                <div class="flex justify-between items-start mb-2">
                                    <span class="text-[9px] font-bold px-1.5 py-0.5 rounded uppercase 
                                        {{ $task->priority === 'high' ? 'bg-red-50 text-red-600' : ($task->priority === 'medium' ? 'bg-yellow-50 text-yellow-600' : 'bg-sena-greenLight text-sena-green') }}">
                                        {{ $task->priority }}
                                    </span>
                                </div>
                                <h4 class="text-sm font-semibold text-sena-gray900 mb-2">{{ $task->title }}</h4>
                                @if($task->description)
                                    <p class="text-xs text-sena-gray400 line-clamp-2 mb-4">{{ $task->description }}</p>
                                @endif
                                <div class="flex justify-between items-center">
                                    <div class="flex -space-x-2">
                                        @if($task->assignee)
                                            <img src="{{ $task->assignee->avatar_url }}" class="w-6 h-6 rounded-full border-2 border-white" title="{{ $task->assignee->name }}">
                                        @else
                                            <div class="w-6 h-6 rounded-full bg-sena-gray100 border-2 border-white flex items-center justify-center" title="Sin asignar">
                                                <i class="bi bi-person text-[10px] text-sena-gray400"></i>
                                            </div>
                                        @endif
                                    </div>
                                    @if($task->due_date && $status !== 'done')
                                        <div class="flex items-center text-[10px] font-bold {{ \Carbon\Carbon::parse($task->due_date)->isPast() ? 'text-red-500' : 'text-sena-gray400' }}">
                                            <i class="bi bi-calendar-event mr-1"></i> {{ \Carbon\Carbon::parse($task->due_date)->format('d M') }}
                                        </div>
                                    @endif
                                    @if($status === 'done')
                                        <i class="bi bi-check-circle-fill text-sena-green"></i>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Modal Create Task -->
    @if($currentProject)
    <div id="modal-task-create" class="fixed inset-0 bg-sena-navy/50 backdrop-blur-sm z-50 flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-lg shadow-2xl w-full max-w-md overflow-hidden">
            <div class="px-6 py-4 border-b border-sena-gray100 bg-sena-gray50 flex justify-between items-center">
                <h3 class="font-bold text-sena-navy">Nueva Tarea</h3>
                <button onclick="document.getElementById('modal-task-create').classList.add('hidden')" class="text-sena-gray400 hover:text-sena-gray900">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <form action="{{ route('tasks.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <input type="hidden" name="project_id" value="{{ $currentProject->id }}">
                <div>
                    <label class="block text-xs font-bold text-sena-gray400 uppercase mb-1">Título</label>
                    <input type="text" name="title" required class="w-full border-sena-gray200 rounded-md text-sm focus:border-sena-green outline-none p-2 transition-all">
                </div>
                <div>
                    <label class="block text-xs font-bold text-sena-gray400 uppercase mb-1">Descripción</label>
                    <textarea name="description" rows="3" class="w-full border-sena-gray200 rounded-md text-sm focus:border-sena-green outline-none p-2 transition-all"></textarea>
                </div>
                <div class="grid grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-bold text-sena-gray400 uppercase mb-1">Prioridad</label>
                        <select name="priority" class="w-full border-sena-gray200 rounded-md text-sm focus:border-sena-green outline-none p-2 transition-all">
                            <option value="low">Baja</option>
                            <option value="medium" selected>Media</option>
                            <option value="high">Alta</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-sena-gray400 uppercase mb-1">Vencimiento</label>
                        <input type="date" name="due_date" class="w-full border-sena-gray200 rounded-md text-sm focus:border-sena-green outline-none p-2 transition-all">
                    </div>
                </div>
                <div>
                    <label class="block text-xs font-bold text-sena-gray400 uppercase mb-1">Asignar a</label>
                    <select name="assigned_to" class="w-full border-sena-gray200 rounded-md text-sm focus:border-sena-green outline-none p-2 transition-all">
                        <option value="">Sin asignar</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->role }})</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" onclick="document.getElementById('modal-task-create').classList.add('hidden')" class="px-4 py-2 text-sm font-bold text-sena-gray400 hover:text-sena-gray700">Cancelar</button>
                    <button type="submit" class="bg-sena-green text-white px-6 py-2 rounded-md font-bold text-sm hover:bg-sena-greenHover shadow-md">Crear Tarea</button>
                </div>
            </form>
        </div>
    </div>
    @endif

    <!-- Scripts for Drag and Drop -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const columns = ['column-pending', 'column-progress', 'column-done'];
            
            columns.forEach(id => {
                const el = document.getElementById(id);
                if (!el) return;

                new Sortable(el, {
                    group: 'kanban',
                    animation: 150,
                    ghostClass: 'bg-sena-greenLight',
                    chosenClass: 'scale-[1.02]',
                    dragClass: 'shadow-2xl',
                    onEnd: function (evt) {
                        const taskId = evt.item.dataset.id;
                        const toStatus = evt.to.dataset.status;
                        const newOrder = evt.newIndex;

                        fetch('{{ route('tasks.updateOrder') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({
                                task_id: taskId,
                                status: toStatus,
                                order: newOrder
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                console.log('Posición actualizada');
                                // Opcional: Recargar contador de columna
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            alert('No se pudo guardar la posición. Recarga la página.');
                        });
                    },
                });
            });
        });
    </script>

    <style>
        .kanban-column {
            min-height: 200px;
        }
        .custom-scrollbar::-webkit-scrollbar {
            height: 8px;
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #D1D8DF;
            border-radius: 10px;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover {
            background: #003770;
        }
    </style>
</x-app-layout>
