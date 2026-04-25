<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h2 class="font-bold text-xl text-sena-gray900">Auditoría de actividad</h2>
            <p class="text-xs text-sena-gray400">Registro de acciones sobre tareas</p>
        </div>
    </x-slot>

    <div class="bg-white rounded-lg shadow-card p-6 mb-6">
        <form method="get" action="{{ route('admin.activity') }}" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-5 gap-4 items-end">
            <div>
                <label class="block text-[10px] font-bold text-sena-gray400 uppercase mb-1">Acción</label>
                <select name="action" class="w-full border-sena-gray200 rounded-md text-sm focus:border-sena-green">
                    <option value="">Todas</option>
                    <option value="created" @selected(request('action') === 'created')>Creada</option>
                    <option value="updated" @selected(request('action') === 'updated')>Actualizada</option>
                    <option value="status_change" @selected(request('action') === 'status_change')>Cambio de estado</option>
                </select>
            </div>
            <div>
                <label class="block text-[10px] font-bold text-sena-gray400 uppercase mb-1">Usuario</label>
                <select name="user_id" class="w-full border-sena-gray200 rounded-md text-sm focus:border-sena-green">
                    <option value="">Todos</option>
                    @foreach($users as $u)
                        <option value="{{ $u->id }}" @selected((string) request('user_id') === (string) $u->id)>{{ $u->name }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label class="block text-[10px] font-bold text-sena-gray400 uppercase mb-1">Desde</label>
                <input type="date" name="date_from" value="{{ request('date_from') }}" class="w-full border-sena-gray200 rounded-md text-sm focus:border-sena-green">
            </div>
            <div>
                <label class="block text-[10px] font-bold text-sena-gray400 uppercase mb-1">Hasta</label>
                <input type="date" name="date_to" value="{{ request('date_to') }}" class="w-full border-sena-gray200 rounded-md text-sm focus:border-sena-green">
            </div>
            <div class="flex gap-2">
                <button type="submit" class="flex-1 bg-sena-navy text-white text-sm font-bold py-2 rounded-md hover:opacity-90">Filtrar</button>
                <a href="{{ route('admin.activity') }}" class="px-3 py-2 text-sm font-bold text-sena-gray600 border border-sena-gray200 rounded-md hover:bg-sena-gray50">Limpiar</a>
            </div>
        </form>
    </div>

    <div class="bg-white rounded-lg shadow-card overflow-hidden">
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm">
                <thead>
                    <tr class="bg-sena-gray50 border-b border-sena-gray100 text-left text-[10px] font-bold uppercase text-sena-gray400 tracking-wider">
                        <th class="px-4 py-3">Fecha</th>
                        <th class="px-4 py-3">Usuario</th>
                        <th class="px-4 py-3">Acción</th>
                        <th class="px-4 py-3">Tarea / Proyecto</th>
                        <th class="px-4 py-3">Descripción</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-sena-gray100">
                    @forelse($logs as $log)
                        <tr class="hover:bg-sena-gray50/80">
                            <td class="px-4 py-3 whitespace-nowrap text-sena-gray600">{{ $log->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-4 py-3 font-medium text-sena-gray900">{{ $log->user?->name ?? '—' }}</td>
                            <td class="px-4 py-3">
                                <span class="inline-block px-2 py-0.5 rounded text-[10px] font-bold uppercase bg-sena-navyLight text-sena-navy">{{ $log->action }}</span>
                            </td>
                            <td class="px-4 py-3 text-sena-gray700">
                                @if($log->task)
                                    <span class="font-medium">{{ $log->task->title }}</span>
                                    @if($log->task->project)
                                        <span class="block text-[10px] text-sena-gray400 mt-0.5">{{ $log->task->project->name }}</span>
                                    @endif
                                @else
                                    <span class="text-sena-gray400">—</span>
                                @endif
                            </td>
                            <td class="px-4 py-3 text-sena-gray600 max-w-md">{{ $log->description }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-4 py-16 text-center text-sena-gray400">
                                <i class="bi bi-journal-x text-3xl block mb-2"></i>
                                No hay registros con los filtros seleccionados.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($logs->hasPages())
            <div class="px-4 py-3 border-t border-sena-gray100">
                {{ $logs->links() }}
            </div>
        @endif
    </div>
</x-app-layout>
