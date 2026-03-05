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
                        <div class="w-20 h-20 rounded-full border-[8px] border-red-400 border-b-transparent flex items-center justify-center shadow-inner">
                             <span class="text-sm font-bold text-red-400">{{ $task_distribution['pending'] }}%</span>
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
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="text-[10px] uppercase font-bold text-sena-gray400 tracking-widest border-b border-sena-gray100">
                           <th class="px-6 py-4">Última Actualización</th>
                           <th class="px-6 py-4">Usuario Responsable</th>
                           <th class="px-6 py-4">Tarea / Proyecto</th>
                           <th class="px-6 py-4">Estado Actual</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-sena-gray50">
                        @forelse($recent_activities as $activity)
                        <tr class="hover:bg-sena-gray50/50 transition-colors">
                            <td class="px-6 py-4 text-xs font-medium text-sena-gray400">{{ $activity->updated_at->format('d/m/Y H:i') }}</td>
                            <td class="px-6 py-4">
                                <span class="font-bold text-sena-navy">{{ $activity->creator->name }}</span>
                            </td>
                            <td class="px-6 py-4">
                                <div class="text-xs font-bold text-sena-gray900">{{ $activity->title }}</div>
                                <div class="text-[10px] text-sena-gray400">{{ $activity->project->name }}</div>
                            </td>
                            <td class="px-6 py-4">
                                <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase
                                    {{ $activity->status === 'done' ? 'bg-sena-greenLight text-sena-green' : ($activity->status === 'progress' ? 'bg-blue-50 text-blue-600' : 'bg-red-50 text-red-600') }}">
                                    {{ $activity->status }}
                                </span>
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
        <button class="bg-sena-navy text-white px-6 py-2 rounded-md font-bold text-sm hover:bg-sena-navyLight transition-all flex items-center shadow-md">
            <i class="bi bi-file-earmark-pdf mr-2"></i> PDF Institucional
        </button>
        <button class="bg-sena-green text-white px-6 py-2 rounded-md font-bold text-sm hover:bg-sena-greenHover transition-all flex items-center shadow-md">
            <i class="bi bi-file-earmark-spreadsheet mr-2"></i> Excel (XLSX)
        </button>
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
