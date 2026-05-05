<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-sena-gray900">Informe de Gestión Institucional</h2>
    </x-slot>

    <div class="space-y-8">
        <!-- Resumen de Métricas -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Rendimiento por Ficha -->
            <div class="bg-white p-6 rounded-lg shadow-card">
                <h3 class="font-bold text-sena-gray900 mb-6 flex items-center">
                    <i class="bi bi-bar-chart-line mr-2 text-sena-green"></i>
                    Cumplimiento por Proyecto / Ficha
                </h3>
                <div class="space-y-5 max-h-[400px] overflow-y-auto pr-2 custom-scrollbar">
                    @forelse($projects as $project)
                        <div class="group">
                            <div class="flex justify-between text-xs mb-1.5">
                                <span class="font-bold text-sena-gray700">{{ $project->name }} ({{ $project->code }})</span>
                                @php
                                    $percentage = $project->tasks_count > 0 ? round(($project->completed_tasks_count / $project->tasks_count) * 100) : 0;
                                @endphp
                                <span class="text-sena-green font-bold">{{ $percentage }}%</span>
                            </div>
                            <div class="w-full bg-sena-gray100 h-2.5 rounded-full overflow-hidden">
                                <div class="bg-sena-green h-full rounded-full shadow-sm transition-all duration-1000" style="width: {{ $percentage }}%"></div>
                            </div>
                        </div>
                    @empty
                        <p class="text-sm text-sena-gray400 text-center py-10">No hay proyectos registrados para analizar.</p>
                    @endforelse
                </div>
            </div>

            <!-- Tareas por Estado -->
            <div class="bg-white p-6 rounded-lg shadow-card">
                <h3 class="font-bold text-sena-gray900 mb-6 flex items-center">
                    <i class="bi bi-pie-chart mr-2 text-sena-navy"></i>
                    Distribución de Tareas (%)
                </h3>
                <div class="flex items-center justify-around h-64">
                     <div class="flex flex-col items-center">
                        <div class="w-20 h-20 rounded-full border-[8px] border-sena-green border-t-transparent flex items-center justify-center shadow-inner">
                             <span class="text-sm font-bold text-sena-green">{{ $task_distribution['done'] }}%</span>
                        </div>
                        <span class="text-[10px] uppercase font-bold text-sena-gray400 mt-3">Completas</span>
                     </div>
                     <div class="flex flex-col items-center">
                        <div class="w-20 h-20 rounded-full border-[8px] border-blue-500 border-l-transparent flex items-center justify-center shadow-inner">
                             <span class="text-sm font-bold text-blue-500">{{ $task_distribution['progress'] }}%</span>
                        </div>
                        <span class="text-[10px] uppercase font-bold text-sena-gray400 mt-3">En Proceso</span>
                     </div>
                     <div class="flex flex-col items-center">
                        <div class="w-20 h-20 rounded-full border-[8px] border-amber-500 border-b-transparent flex items-center justify-center shadow-inner">
                             <span class="text-sm font-bold text-amber-700">{{ $task_distribution['pending'] }}%</span>
                        </div>
                        <span class="text-[10px] uppercase font-bold text-sena-gray400 mt-3">Pendientes</span>
                     </div>
                </div>
            </div>
        </div>

        <!-- Tabla Resumen Real -->
        <div class="bg-white rounded-lg shadow-card overflow-hidden">
            <div class="px-6 py-4 border-b border-sena-gray100 bg-sena-gray50/30">
                <h3 class="font-bold text-sena-gray900">Historial de Actividad Reciente</h3>
            </div>
            <div class="relative overflow-x-auto">
                <table class="w-full min-w-[720px] table-fixed border-collapse text-left text-sm">
                    <colgroup>
                        <col class="w-[148px]" />
                        <col class="w-[200px]" />
                        <col />
                        <col class="w-[180px]" />
                    </colgroup>
                    <thead>
                        <tr class="border-b-2 border-sena-gray200 shadow-sm">
                           <th scope="col" class="sticky top-0 z-20 bg-sena-gray100 px-5 py-4 text-left text-xs font-bold uppercase tracking-wide text-sena-gray800 whitespace-nowrap">Última actualización</th>
                           <th scope="col" class="sticky top-0 z-20 bg-sena-gray100 px-5 py-4 text-left text-xs font-bold uppercase tracking-wide text-sena-gray800 whitespace-nowrap">Usuario responsable</th>
                           <th scope="col" class="sticky top-0 z-20 bg-sena-gray100 px-5 py-4 text-left text-xs font-bold uppercase tracking-wide text-sena-gray800">Tarea / proyecto</th>
                           <th scope="col" class="sticky top-0 z-20 bg-sena-gray100 px-5 py-4 text-left text-xs font-bold uppercase tracking-wide text-sena-gray800 whitespace-nowrap">Estado actual</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-sena-gray100">
                        @forelse($recent_activities as $activity)
                        @php
                            $statusPill = match ($activity->status) {
                                'done' => 'bg-emerald-50 text-emerald-800 ring-1 ring-emerald-200/80',
                                'progress' => 'bg-blue-50 text-blue-800 ring-1 ring-blue-200/80',
                                'pending' => 'bg-amber-50 text-amber-900 ring-1 ring-amber-200/90',
                                default => 'bg-sena-gray100 text-sena-gray700 ring-1 ring-sena-gray-200/80',
                            };
                            $statusLabel = match ($activity->status) {
                                'done' => 'Completada',
                                'progress' => 'En proceso',
                                'pending' => 'Pendiente',
                                default => strtoupper($activity->status),
                            };
                        @endphp
                        <tr class="odd:bg-white even:bg-sena-gray50/70 hover:bg-sena-navyLight/25 transition-colors">
                            <td class="px-5 py-4 align-middle whitespace-nowrap tabular-nums text-xs font-medium text-sena-gray600 border-r border-sena-gray100/80">{{ $activity->updated_at->format('d/m/Y H:i') }}</td>
                            <td class="px-5 py-4 align-middle border-r border-sena-gray100/80">
                                <span class="font-bold text-sena-navy">{{ $activity->creator->name }}</span>
                            </td>
                            <td class="px-5 py-4 align-middle border-r border-sena-gray100/80">
                                <div class="text-xs font-bold text-sena-gray900 leading-snug">{{ $activity->title }}</div>
                                <div class="text-[11px] text-sena-gray500 mt-1">{{ $activity->project->name }}</div>
                            </td>
                            <td class="px-5 py-4 align-middle">
                                <span class="kanban-pill normal-case tracking-normal font-semibold {{ $statusPill }}">{{ $statusLabel }}</span>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="px-6 py-10 text-center text-sena-gray400 italic">No se ha registrado actividad reciente.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Filtros de Reporte (UI placeholder for future implementation) -->
    <div class="bg-white p-6 rounded-lg shadow-card flex flex-wrap gap-4 items-end mt-8 border-t-2 border-sena-navy">
        <div class="space-y-1.5 flex-1">
            <h4 class="text-sm font-bold text-sena-navy uppercase">Exportar Datos</h4>
            <p class="text-xs text-sena-gray400">Genera un documento oficial con el estado actual de los proyectos.</p>
        </div>
        <a href="{{ route('reports.export.pdf') }}" class="bg-sena-navy text-white px-6 py-2 rounded-md font-bold text-sm hover:opacity-90 transition-all inline-flex items-center shadow-md">
            <i class="bi bi-file-earmark-pdf mr-2"></i> PDF Institucional
        </a>
        <a href="{{ route('reports.export.excel') }}" class="bg-sena-green text-white px-6 py-2 rounded-md font-bold text-sm hover:bg-sena-greenHover transition-all inline-flex items-center shadow-md">
            <i class="bi bi-file-earmark-spreadsheet mr-2"></i> Excel (XLSX)
        </a>
    </div>

    <style>
        .custom-scrollbar::-webkit-scrollbar {
            width: 4px;
        }
        .custom-scrollbar::-webkit-scrollbar-track {
            background: #f1f1f1;
        }
        .custom-scrollbar::-webkit-scrollbar-thumb {
            background: #D1D8DF;
            border-radius: 10px;
        }
    </style>
</x-app-layout>
