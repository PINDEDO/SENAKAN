<x-app-layout>
    <x-slot name="header">
        <div class="flex w-full min-w-0 flex-col gap-2 sm:flex-row sm:items-center sm:justify-between sm:gap-4">
            <h2 class="min-w-0 text-xl font-bold text-sena-gray900">Auditoría de actividad</h2>
            <p class="shrink-0 text-xs text-sena-gray400 sm:text-right">Registro de acciones sobre tareas</p>
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
        <div class="relative overflow-x-auto">
            <table class="w-full min-w-[960px] table-fixed border-collapse text-sm">
                <colgroup>
                    <col class="w-[148px]" />
                    <col class="w-[200px]" />
                    <col class="w-[176px]" />
                    <col class="w-[260px]" />
                    <col />
                </colgroup>
                <thead>
                    <tr class="border-b-2 border-sena-gray200 shadow-sm">
                        <th scope="col" class="sticky top-0 z-20 bg-sena-gray100 px-5 py-4 text-left text-xs font-bold uppercase tracking-wide text-sena-gray800 whitespace-nowrap">Fecha</th>
                        <th scope="col" class="sticky top-0 z-20 bg-sena-gray100 px-5 py-4 text-left text-xs font-bold uppercase tracking-wide text-sena-gray800 whitespace-nowrap">Usuario</th>
                        <th scope="col" class="sticky top-0 z-20 bg-sena-gray100 px-5 py-4 text-left text-xs font-bold uppercase tracking-wide text-sena-gray800 whitespace-nowrap">Acción</th>
                        <th scope="col" class="sticky top-0 z-20 bg-sena-gray100 px-5 py-4 text-left text-xs font-bold uppercase tracking-wide text-sena-gray800">Tarea / Proyecto</th>
                        <th scope="col" class="sticky top-0 z-20 bg-sena-gray100 px-5 py-4 text-left text-xs font-bold uppercase tracking-wide text-sena-gray800">Descripción</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-sena-gray100">
                    @forelse($logs as $log)
                        <tr class="odd:bg-white even:bg-sena-gray50/80 hover:bg-sena-navyLight/25 transition-colors">
                            <td class="px-5 py-3.5 align-middle whitespace-nowrap tabular-nums text-sena-gray700 border-r border-sena-gray100/80">{{ $log->created_at->format('d/m/Y H:i') }}</td>
                            <td class="px-5 py-3.5 align-middle font-medium text-sena-gray900 border-r border-sena-gray100/80">{{ $log->user?->name ?? '—' }}</td>
                            <td class="px-5 py-3.5 align-middle border-r border-sena-gray100/80">
                                <span class="kanban-pill bg-sena-navyLight text-sena-navy ring-1 ring-sena-navy/10">{{ $log->action }}</span>
                            </td>
                            <td class="px-5 py-3.5 align-middle text-sena-gray700 border-r border-sena-gray100/80">
                                @if($log->task)
                                    <span class="font-medium block leading-snug">{{ $log->task->title }}</span>
                                    @if($log->task->project)
                                        <span class="block text-[11px] text-sena-gray500 mt-1">{{ $log->task->project->name }}</span>
                                    @endif
                                @else
                                    <span class="text-sena-gray400">—</span>
                                @endif
                            </td>
                            <td class="px-5 py-3.5 align-middle text-sena-gray600 leading-relaxed break-words">{{ $log->description }}</td>
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
