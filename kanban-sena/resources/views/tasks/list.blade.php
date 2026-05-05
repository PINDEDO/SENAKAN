<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-sena-gray900">Lista General de Tareas</h2>
    </x-slot>

    <div class="space-y-6">
        <!-- Filtros -->
        <div class="bg-white p-6 rounded-lg shadow-card">
            <form action="{{ route('tasks.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4 items-end">
                <div>
                    <label class="block text-xs font-bold text-sena-gray400 uppercase mb-1.5">Estado</label>
                    <select name="status" class="w-full border-sena-gray200 rounded-md text-sm focus:border-sena-green focus:ring-sena-greenLight">
                        <option value="">Todos los estados</option>
                        <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pendiente</option>
                        <option value="progress" {{ request('status') == 'progress' ? 'selected' : '' }}>En Proceso</option>
                        <option value="done" {{ request('status') == 'done' ? 'selected' : '' }}>Completado</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-sena-gray400 uppercase mb-1.5">Prioridad</label>
                    <select name="priority" class="w-full border-sena-gray200 rounded-md text-sm focus:border-sena-green focus:ring-sena-greenLight">
                        <option value="">Todas las prioridades</option>
                        <option value="high" {{ request('priority') == 'high' ? 'selected' : '' }}>Alta</option>
                        <option value="medium" {{ request('priority') == 'medium' ? 'selected' : '' }}>Media</option>
                        <option value="low" {{ request('priority') == 'low' ? 'selected' : '' }}>Baja</option>
                    </select>
                </div>
                <div>
                    <label class="block text-xs font-bold text-sena-gray400 uppercase mb-1.5">Proyecto</label>
                    <select name="project_id" class="w-full border-sena-gray200 rounded-md text-sm focus:border-sena-green focus:ring-sena-greenLight">
                        <option value="">Todos los proyectos</option>
                        @foreach(\App\Models\Project::all() as $project)
                            <option value="{{ $project->id }}" {{ request('project_id') == $project->id ? 'selected' : '' }}>{{ $project->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <button type="submit" class="w-full bg-sena-navy text-white font-bold py-2 rounded-md hover:bg-sena-navyLight transition-all flex items-center justify-center">
                        <i class="bi bi-filter mr-2"></i> Filtrar
                    </button>
                </div>
            </form>
        </div>

        <!-- Tabla de Tareas -->
        <div class="bg-white rounded-lg shadow-card overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="text-[10px] uppercase font-bold text-sena-gray400 tracking-widest border-b border-sena-gray100 bg-sena-gray50/30">
                           <th class="px-6 py-4">Tarea</th>
                           <th class="px-6 py-4">Proyecto</th>
                           <th class="px-6 py-4">Prioridad</th>
                           <th class="px-6 py-4">Estado</th>
                           <th class="px-6 py-4">Asignado</th>
                           <th class="px-6 py-4">Vencimiento</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-sena-gray100">
                        @forelse($tasks as $task)
                        @php
                            $priorityPill = match ($task->priority) {
                                'high' => 'bg-red-50 text-red-800 ring-1 ring-red-200/80',
                                'medium' => 'bg-orange-50 text-orange-800 ring-1 ring-orange-200/80',
                                default => 'bg-blue-50 text-blue-800 ring-1 ring-blue-200/80',
                            };
                            $statusPill = match ($task->status) {
                                'done' => 'bg-emerald-50 text-emerald-800 ring-1 ring-emerald-200/80',
                                'progress' => 'bg-blue-50 text-blue-800 ring-1 ring-blue-200/80',
                                default => 'bg-sena-gray100 text-sena-gray600 ring-1 ring-sena-gray-200/80',
                            };
                        @endphp
                        <tr class="odd:bg-white even:bg-sena-gray50/70 hover:bg-sena-navyLight/25 transition-colors">
                            <td class="px-6 py-4 align-middle">
                                <span class="font-bold text-sena-navy">{{ $task->title }}</span>
                                <p class="text-[10px] text-sena-gray400 truncate max-w-[200px]">{{ $task->description }}</p>
                            </td>
                            <td class="px-6 py-4 align-middle">
                                <span class="text-xs font-medium text-sena-gray700">{{ $task->project->name }}</span>
                            </td>
                            <td class="px-6 py-4 align-middle">
                                <span class="kanban-pill {{ $priorityPill }}">{{ $task->priority }}</span>
                            </td>
                            <td class="px-6 py-4 align-middle">
                                <span class="kanban-pill {{ $statusPill }}">{{ $task->status }}</span>
                            </td>
                            <td class="px-6 py-4 align-middle">
                                @if($task->assignee)
                                    <div class="flex items-center space-x-2">
                                        <img src="{{ $task->assignee->avatar_url }}" class="w-5 h-5 rounded-full">
                                        <span class="text-xs">{{ $task->assignee->name }}</span>
                                    </div>
                                @else
                                    <span class="text-[10px] text-sena-gray400 italic">Sin asignar</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 align-middle">
                                <span class="text-[10px] font-bold {{ $task->due_date && $task->due_date->isPast() && $task->status !== 'done' ? 'text-red-500' : 'text-sena-gray400' }}">
                                    {{ $task->due_date ? $task->due_date->format('d/m/Y') : 'N/A' }}
                                </span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="px-6 py-10 text-center text-sena-gray400 italic">No se encontraron tareas con estos criterios.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
            
            @if($tasks->hasPages())
                <div class="px-6 py-4 border-t border-sena-gray100">
                    {{ $tasks->links() }}
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
