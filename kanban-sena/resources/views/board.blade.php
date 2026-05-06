<x-app-layout>
    <x-slot name="header">
        <div class="flex w-full min-w-0 flex-col gap-3 lg:flex-row lg:items-center lg:gap-4">
            <div class="flex min-w-0 flex-1 flex-wrap items-center gap-3">
                <h2 class="shrink-0 text-xl font-bold text-sena-navy">Tablero Kanban</h2>
                @if($projects->count() > 0)
                <select onchange="window.location.href='?project_id=' + this.value" class="min-w-0 max-w-full flex-1 rounded-md border border-sena-gray200 bg-white py-1.5 text-sm shadow-sm outline-none focus:border-sena-green focus:ring-2 focus:ring-sena-green focus:ring-offset-2 sm:max-w-md sm:flex-initial">
                    @foreach($projects as $project)
                        <option value="{{ $project->id }}" {{ $currentProject && $currentProject->id == $project->id ? 'selected' : '' }}>
                            {{ $project->name }} ({{ $project->code }})
                        </option>
                    @endforeach
                </select>
                @endif
            </div>
            @if($currentProject)
            <button type="button" onclick="openModal()" class="flex shrink-0 items-center whitespace-nowrap rounded-md bg-sena-green px-4 py-2 text-sm font-bold text-white shadow-sm transition-all hover:bg-sena-darkgreen focus:outline-none focus:ring-2 focus:ring-sena-green focus:ring-offset-2">
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
            @foreach(['pending' => 'Por hacer', 'progress' => 'En progreso', 'done' => 'Completado'] as $status => $label)
                <div class="flex-shrink-0 w-80 flex flex-col h-full rounded-xl overflow-hidden border border-sena-gray200 shadow-card bg-white">
                    <div class="px-4 py-3 flex justify-between items-center bg-sena-navy text-white border-b border-white/10">
                        <h3 class="text-xs font-semibold uppercase tracking-widest flex items-center gap-2 leading-snug">
                            @if($status === 'progress')
                                <span class="w-2 h-2 rounded-full bg-sena-yellow shrink-0 animate-pulse" aria-hidden="true"></span>
                            @elseif($status === 'done')
                                <i class="bi bi-check-all text-base text-sena-green shrink-0" aria-hidden="true"></i>
                            @else
                                <span class="w-2 h-2 rounded-full bg-white/50 shrink-0" aria-hidden="true"></span>
                            @endif
                            {{ $label }}
                        </h3>
                        <span class="inline-flex min-w-[1.75rem] justify-center rounded-full bg-white/15 px-2 py-0.5 text-xs font-bold text-white tabular-nums">
                            {{ $tasks[$status]->count() }}
                        </span>
                    </div>
                    <div id="column-{{ $status }}" data-status="{{ $status }}" class="flex-1 p-3 space-y-3 overflow-y-auto kanban-column bg-sena-colbg">
                        @foreach($tasks[$status] as $task)
                            @php
                                $prioBorder = match ($task->priority) {
                                    'high' => 'border-l-red-500',
                                    'medium' => 'border-l-sena-yellow',
                                    default => 'border-l-sena-green',
                                };
                                $prio = match ($task->priority) {
                                    'high' => 'bg-red-50 text-red-800 ring-1 ring-red-200/80',
                                    'medium' => 'bg-amber-50 text-amber-900 ring-1 ring-amber-200/80',
                                    default => 'bg-sena-greenLight text-sena-darkgreen ring-1 ring-sena-green/30',
                                };
                            @endphp
                            <div class="task-card group bg-white p-4 rounded-lg shadow-card border border-sena-gray200 border-l-4 {{ $prioBorder }} cursor-grab active:cursor-grabbing hover:shadow-md hover:border-sena-green/40 transition-all duration-200"
                                 data-id="{{ $task->id }}">
                                <div class="flex justify-between items-start mb-3">
                                    <span class="kanban-pill normal-case {{ $prio }}">{{ $task->priority }}</span>
                                    <div class="flex items-center space-x-1 opacity-0 group-hover:opacity-100 transition-opacity">
                                        <button type="button" onclick="editTask({{ json_encode($task) }})" class="p-1 rounded text-sena-gray400 hover:text-sena-navy hover:bg-sena-gray50 focus:outline-none focus:ring-2 focus:ring-sena-green focus:ring-offset-1">
                                            <i class="bi bi-pencil-square"></i>
                                        </button>
                                        <i class="bi bi-grip-vertical text-sena-gray200"></i>
                                    </div>
                                </div>
                                <h4 class="text-sm font-semibold text-sena-gray900 mb-2 leading-snug">{{ $task->title }}</h4>
                                @if($task->description)
                                    <p class="text-xs text-sena-gray700 line-clamp-2 mb-3 leading-relaxed">{{ $task->description }}</p>
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
                        <input type="text" name="title" id="taskTitle" required class="w-full border-sena-gray200 rounded-md text-sm focus:border-sena-green focus:ring-2 focus:ring-sena-green focus:ring-offset-2" placeholder="Nombre de la tarea">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-sena-gray700 uppercase mb-1">Descripción</label>
                        <textarea name="description" id="taskDescription" class="w-full border-sena-gray200 rounded-md text-sm focus:border-sena-green focus:ring-2 focus:ring-sena-green focus:ring-offset-2" rows="3" placeholder="Detalles de la actividad"></textarea>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-sena-gray700 uppercase mb-1">Prioridad</label>
                            <select name="priority" id="taskPriority" class="w-full border-sena-gray200 rounded-md text-sm focus:border-sena-green focus:ring-2 focus:ring-sena-green focus:ring-offset-2">
                                <option value="low">Baja</option>
                                <option value="medium" selected>Media</option>
                                <option value="high">Alta</option>
                            </select>
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-sena-gray700 uppercase mb-1">Vencimiento</label>
                            <input type="date" name="due_date" id="taskDueDate" class="w-full border-sena-gray200 rounded-md text-sm focus:border-sena-green focus:ring-2 focus:ring-sena-green focus:ring-offset-2">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-sena-gray700 uppercase mb-1">Asignar a</label>
                        <select name="assigned_to" id="taskAssignedTo" class="w-full border-sena-gray200 rounded-md text-sm focus:border-sena-green focus:ring-2 focus:ring-sena-green focus:ring-offset-2">
                            <option value="">Sin asignar</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}">{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="pt-4">
                        <button type="submit" class="w-full bg-sena-green text-white font-bold py-2 rounded-md hover:bg-sena-darkgreen transition-all shadow-md focus:outline-none focus:ring-2 focus:ring-sena-green focus:ring-offset-2">
                            Guardar Tarea
                        </button>
                    </div>
                </form>

                @include('components.task-comments')
            </div>
        </div>
    </div>

    <!-- Scripts for Drag and Drop -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        const kanbanUserId = {{ json_encode((int) auth()->id()) }};
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function taskCommentsBaseUrl(taskId) {
            return '{{ url('/tasks') }}/' + taskId + '/comments';
        }

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
            const csec = document.getElementById('taskCommentsSection');
            if (csec) {
                csec.classList.add('hidden');
                document.getElementById('taskCommentsList').innerHTML = '';
                document.getElementById('newCommentBody').value = '';
            }
            window.__kanbanEditingTaskId = null;
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
            const csec = document.getElementById('taskCommentsSection');
            if (csec) {
                csec.classList.remove('hidden');
                document.getElementById('newCommentBody').value = '';
                window.__kanbanEditingTaskId = task.id;
                loadTaskComments(task.id);
            }
        }

        function loadTaskComments(taskId) {
            const list = document.getElementById('taskCommentsList');
            if (!list) return;
            list.innerHTML = '<li class="text-sena-gray400">Cargando comentarios…</li>';
            fetch(taskCommentsBaseUrl(taskId), {
                headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
            })
            .then(r => r.json())
            .then(data => {
                const rows = (data.data || []);
                if (!rows.length) {
                    list.innerHTML = '<li class="text-sena-gray400">Sin comentarios aún.</li>';
                    return;
                }
                list.innerHTML = rows.map(c => {
                    const del = (c.user_id === kanbanUserId)
                        ? '<button type="button" class="ml-2 text-red-600 hover:underline text-[10px] font-semibold" data-comment-delete="' + c.id + '">Eliminar</button>'
                        : '';
                    return '<li class="rounded-md border border-sena-gray100 bg-white p-2" data-comment-id="' + c.id + '">' +
                        '<div class="mb-1 flex items-center justify-between gap-2">' +
                        '<span class="font-semibold text-sena-navy">' + escapeHtml(c.user?.name || 'Usuario') + '</span>' +
                        '<span class="text-[10px] text-sena-gray400">' + (c.created_at || '').replace('T', ' ').slice(0, 16) + '</span>' +
                        '</div>' +
                        '<p class="whitespace-pre-wrap text-sena-gray800 leading-relaxed">' + escapeHtml(c.body) + '</p>' +
                        del +
                        '</li>';
                }).join('');
                list.querySelectorAll('[data-comment-delete]').forEach(btn => {
                    btn.addEventListener('click', function () {
                        const cid = btn.getAttribute('data-comment-delete');
                        if (!cid || !confirm('¿Eliminar este comentario?')) return;
                        fetch('{{ url('/comments') }}/' + cid, {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'Accept': 'application/json',
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        }).then(() => loadTaskComments(taskId)).catch(() => alert('No se pudo eliminar.'));
                    });
                });
            })
            .catch(() => { list.innerHTML = '<li class="text-red-600">Error al cargar comentarios.</li>'; });
        }

        function escapeHtml(s) {
            const d = document.createElement('div');
            d.textContent = s;
            return d.innerHTML;
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
            const btnPost = document.getElementById('btnPostComment');
            if (btnPost) {
                btnPost.addEventListener('click', function () {
                    const taskId = window.__kanbanEditingTaskId;
                    const body = (document.getElementById('newCommentBody') || {}).value || '';
                    if (!taskId || !body.trim()) return;
                    fetch(taskCommentsBaseUrl(taskId), {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': csrfToken,
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        },
                        body: JSON.stringify({ body: body.trim() })
                    })
                    .then(r => { if (!r.ok) throw new Error(); return r.json(); })
                    .then(() => {
                        document.getElementById('newCommentBody').value = '';
                        loadTaskComments(taskId);
                    })
                    .catch(() => alert('No se pudo publicar el comentario.'));
                });
            }

            const columns = ['column-pending', 'column-progress', 'column-done'];
            
            columns.forEach(columnId => {
                const el = document.getElementById(columnId);
                if (el) {
                    new Sortable(el, {
                        group: 'tasks',
                        animation: 150,
                        ghostClass: 'sortable-ghost',
                        chosenClass: 'sortable-chosen',
                        dragClass: 'sortable-drag',
                        onStart: function (evt) {
                            evt.item.classList.add('rotate-1');
                        },
                        onEnd: function (evt) {
                            evt.item.classList.remove('rotate-1');
                            const taskId = evt.item.getAttribute('data-id');
                            const newStatus = evt.to.getAttribute('data-status');
                            const order = Array.from(evt.to.children).indexOf(evt.item);

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
            background: #00304D;
        }
    </style>
</x-app-layout>
