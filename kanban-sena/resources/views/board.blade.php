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
            <button onclick="openModal()" class="bg-sena-green text-white px-4 py-2 rounded-md font-bold text-sm flex items-center hover:bg-sena-greenHover transition-all shadow-sm">
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
                            <div class="task-card group bg-white p-4 rounded-lg shadow-sm border border-sena-gray100 cursor-grab active:cursor-grabbing hover:border-sena-green/30 hover:shadow-md transition-all duration-200"
                                 data-id="{{ $task->id }}">
                                <div class="flex justify-between items-start mb-3">
                                    <span class="px-2 py-0.5 rounded text-[10px] font-bold uppercase tracking-wider
                                        {{ $task->priority === 'high' ? 'bg-red-50 text-red-600' : ($task->priority === 'medium' ? 'bg-orange-50 text-orange-600' : 'bg-blue-50 text-blue-600') }}">
                                        {{ $task->priority }}
                                    </span>
                                    <div class="flex items-center space-x-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button onclick="editTask({{ json_encode($task) }})" class="p-1 hover:bg-sena-gray50 rounded text-sena-gray400 hover:text-sena-navy">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <i class="bi bi-grip-vertical text-sena-gray200"></i>
                                    </div>
                                </div>
                                <h4 class="text-sm font-bold text-sena-gray900 mb-2 leading-tight">{{ $task->title }}</h4>
                                @if($task->description)
                                    <p class="text-xs text-sena-gray400 line-clamp-2 mb-3">{{ $task->description }}</p>
                                @endif
                                <div class="flex items-center justify-between pt-3 border-t border-sena-gray50">
                                    <div class="flex -space-x-2">
                                        @if($task->assignee)
                                            <img src="{{ $task->assignee->avatar_url }}" alt="avatar" class="w-6 h-6 rounded-full border-2 border-white" title="{{ $task->assignee->name }}">
                                        @else
                                            <div class="w-6 h-6 rounded-full bg-sena-gray100 border-2 border-white flex items-center justify-center text-[10px] text-sena-gray400">?</div>
                                        @endif
                                    </div>
                                    @if($task->due_date)
                                        <span class="text-[10px] font-bold text-sena-gray400 flex items-center">
                                            <i class="bi bi-calendar3 mr-1"></i> {{ $task->due_date->format('d M') }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Modal: Nueva / Editar Tarea -->
    <div id="taskModal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-sena-navy/60 backdrop-blur-sm"></div>
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-md relative animate-in fade-in zoom-in duration-200">
                <div class="px-6 py-4 border-b border-sena-gray100 flex justify-between items-center">
                    <h3 id="modalTitle" class="font-bold text-sena-navy">Nueva Tarea</h3>
                    <button onclick="closeModal()" class="text-sena-gray400 hover:text-sena-gray600">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                <form id="taskForm" method="POST" action="{{ route('tasks.store') }}" class="p-6 space-y-4">
                    @csrf
                    <input type="hidden" name="_method" id="formMethod" value="POST">
                    <input type="hidden" name="project_id" value="{{ $currentProject?->id }}">
                    
                    <div>
                        <label class="block text-xs font-bold text-sena-gray700 uppercase mb-1">Título</label>
                        <input type="text" name="title" id="taskTitle" required class="w-full border-sena-gray200 rounded-md focus:border-sena-green focus:ring-sena-greenLight text-sm" placeholder="Nombre de la tarea">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-sena-gray700 uppercase mb-1">Descripción</label>
                        <textarea name="description" id="taskDescription" class="w-full border-sena-gray200 rounded-md focus:border-sena-green focus:ring-sena-greenLight text-sm" rows="3" placeholder="Detalles de la actividad"></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-sena-gray700 uppercase mb-1">Prioridad</label>
                            <select name="priority" id="taskPriority" class="w-full border-sena-gray200 rounded-md focus:border-sena-green focus:ring-sena-greenLight text-sm">
                                <option value="low">Baja</option>
                                <option value="medium" selected>Media</option>
                                <option value="high">Alta</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-sena-gray700 uppercase mb-1">Vencimiento</label>
                            <input type="date" name="due_date" id="taskDueDate" class="w-full border-sena-gray200 rounded-md focus:border-sena-green focus:ring-sena-greenLight text-sm">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-sena-gray700 uppercase mb-1">Asignar a</label>
                        <select name="assigned_to" id="taskAssignedTo" class="w-full border-sena-gray200 rounded-md focus:border-sena-green focus:ring-sena-greenLight text-sm">
                            <option value="">Sin asignar</option>
                            @foreach(\App\Models\User::all() as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="pt-4">
                        <button type="submit" class="w-full bg-sena-green text-white font-bold py-2 rounded-md hover:bg-sena-greenHover transition-all shadow-md">
                            Guardar Tarea
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Scripts for Drag and Drop -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        function openModal() {
            document.getElementById('modalTitle').textContent = 'Nueva Tarea';
            document.getElementById('taskForm').action = "{{ route('tasks.store') }}";
            document.getElementById('formMethod').value = "POST";
            document.getElementById('taskTitle').value = '';
            document.getElementById('taskDescription').value = '';
            document.getElementById('taskPriority').value = 'medium';
            document.getElementById('taskDueDate').value = '';
            document.getElementById('taskAssignedTo').value = '';
            document.getElementById('taskModal').classList.remove('hidden');
        }

        function editTask(task) {
            document.getElementById('modalTitle').textContent = 'Editar Tarea';
            document.getElementById('taskForm').action = `/tasks/${task.id}`;
            document.getElementById('formMethod').value = "PUT";
            document.getElementById('taskTitle').value = task.title;
            document.getElementById('taskDescription').value = task.description || '';
            document.getElementById('taskPriority').value = task.priority;
            document.getElementById('taskDueDate').value = task.due_date ? task.due_date.split('T')[0] : '';
            document.getElementById('taskAssignedTo').value = task.assigned_to || '';
            document.getElementById('taskModal').classList.remove('hidden');
        }

        function closeModal() {
            document.getElementById('taskModal').classList.add('hidden');
        }

        document.getElementById('taskForm').addEventListener('submit', function(e) {
            const title = document.getElementById('taskTitle').value;
            if (!title) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Campo Requerido',
                    text: 'Por favor, asigne un título a la tarea antes de continuar.',
                    confirmButtonColor: '#39A900'
                });
            }
        });

        document.addEventListener('DOMContentLoaded', function() {
            const columns = ['column-pending', 'column-progress', 'column-done'];
            
            columns.forEach(columnId => {
                const el = document.getElementById(columnId);
                if (el) {
                    new Sortable(el, {
                        group: 'tasks',
                        animation: 150,
                        ghostClass: 'opacity-20',
                        chosenClass: 'scale-[1.02]',
                        dragClass: 'shadow-2xl',
                        onStart: function (evt) {
                            evt.item.classList.add('rotate-1');
                        },
                        onEnd: function (evt) {
                            evt.item.classList.remove('rotate-1');
                            const taskId = evt.item.getAttribute('data-id');
                            const newStatus = evt.to.getAttribute('data-status');
                            const order = Array.from(evt.to.children).indexOf(evt.item);

                            // Cambiar color de la card dinámicamente según el destino
                            const card = evt.item;
                            card.classList.remove('border-sena-gray100', 'border-blue-200', 'border-sena-green/30');
                            if (newStatus === 'progress') card.classList.add('border-blue-200');
                            else if (newStatus === 'done') card.classList.add('border-sena-green/30');
                            else card.classList.add('border-sena-gray100');

                            fetch("{{ route('tasks.updateOrder') }}", {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                                },
                                body: JSON.stringify({
                                    task_id: taskId,
                                    status: newStatus,
                                    order: order
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    console.log('Orden actualizado');
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('No se pudo guardar la posición. Recarga la página.');
                            });
                        }
                    });
                }
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
