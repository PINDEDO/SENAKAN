<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-xl text-sena-gray900">Informe de Gestión Institucional</h2>
    </x-slot>

    <div class="space-y-8">
        <!-- Filtros de Reporte -->
        <div class="bg-white p-6 rounded-lg shadow-card flex flex-wrap gap-4 items-end">
            <div class="space-y-1.5">
                <label class="text-[10px] font-bold text-sena-gray400 uppercase tracking-widest">Rango de Fecha</label>
                <input type="date" class="block w-full border-sena-gray200 rounded-md text-sm focus:border-sena-green transition-all">
            </div>
            <div class="space-y-1.5">
                <label class="text-[10px] font-bold text-sena-gray400 uppercase tracking-widest">Centro de Formación</label>
                <select class="block w-full border-sena-gray200 rounded-md text-sm focus:border-sena-green transition-all">
                    <option>Centro de Electricidad y Automatización</option>
                    <option>Centro de Gestión Tecnológica</option>
                </select>
            </div>
            <button class="bg-sena-navy text-white px-6 py-2 rounded-md font-bold text-sm hover:bg-sena-navyLight transition-all">
                Generar Reporte
            </button>
            <button class="border border-sena-gray200 text-sena-gray700 px-6 py-2 rounded-md font-bold text-sm hover:bg-sena-gray50 transition-all flex items-center">
                <i class="bi bi-download mr-2"></i> Exportar PDF
            </button>
        </div>

        <!-- Visualizaciones (Placeholders con Tailwind) -->
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- Rendimiento por Ficha -->
            <div class="bg-white p-6 rounded-lg shadow-card">
                <h3 class="font-bold text-sena-gray900 mb-6 flex items-center">
                    <i class="bi bi-bar-chart-line mr-2 text-sena-green"></i>
                    Cumplimiento por Ficha
                </h3>
                <div class="space-y-5">
                    <div class="group">
                        <div class="flex justify-between text-xs mb-1.5">
                            <span class="font-bold text-sena-gray700">Ficha #287465 - ADSO</span>
                            <span class="text-sena-green font-bold">88%</span>
                        </div>
                        <div class="w-full bg-sena-gray100 h-2.5 rounded-full overflow-hidden">
                            <div class="bg-sena-green h-full rounded-full w-[88%] shadow-sm"></div>
                        </div>
                    </div>
                    <div class="group">
                        <div class="flex justify-between text-xs mb-1.5">
                            <span class="font-bold text-sena-gray700">Ficha #280122 - Multimedia</span>
                            <span class="text-sena-navy font-bold">42%</span>
                        </div>
                        <div class="w-full bg-sena-gray100 h-2.5 rounded-full overflow-hidden">
                            <div class="bg-sena-navy h-full rounded-full w-[42%] shadow-sm"></div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tareas por Estado -->
            <div class="bg-white p-6 rounded-lg shadow-card">
                <h3 class="font-bold text-sena-gray900 mb-6 flex items-center">
                    <i class="bi bi-pie-chart mr-2 text-sena-navy"></i>
                    Distribución de Tareas
                </h3>
                <div class="flex items-center justify-around h-32">
                     <div class="flex flex-col items-center">
                        <div class="w-16 h-16 rounded-full border-[6px] border-sena-green border-t-transparent flex items-center justify-center">
                             <span class="text-xs font-bold text-sena-green">60%</span>
                        </div>
                        <span class="text-[10px] uppercase font-bold text-sena-gray400 mt-2">Completas</span>
                     </div>
                     <div class="flex flex-col items-center">
                        <div class="w-16 h-16 rounded-full border-[6px] border-blue-500 border-l-transparent flex items-center justify-center">
                             <span class="text-xs font-bold text-blue-500">25%</span>
                        </div>
                        <span class="text-[10px] uppercase font-bold text-sena-gray400 mt-2">En Proceso</span>
                     </div>
                     <div class="flex flex-col items-center">
                        <div class="w-16 h-16 rounded-full border-[6px] border-red-400 flex items-center justify-center">
                             <span class="text-xs font-bold text-red-400">15%</span>
                        </div>
                        <span class="text-[10px] uppercase font-bold text-sena-gray400 mt-2">Pendientes</span>
                     </div>
                </div>
            </div>
        </div>

        <!-- Tabla Resumen -->
        <div class="bg-white rounded-lg shadow-card overflow-hidden">
            <div class="px-6 py-4 border-b border-sena-gray100 bg-sena-gray50/30">
                <h3 class="font-bold text-sena-gray900">Historial de Actividad Reciente</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="text-[10px] uppercase font-bold text-sena-gray400 tracking-widest border-b border-sena-gray100">
                           <th class="px-6 py-4">Fecha</th>
                           <th class="px-6 py-4">Usuario</th>
                           <th class="px-6 py-4">Acción</th>
                           <th class="px-6 py-4">Resultado</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-sena-gray50 italic">
                        <tr>
                            <td class="px-6 py-4 text-xs">2026-03-04 14:22</td>
                            <td class="px-6 py-4 font-bold text-sena-navy">Admin User</td>
                            <td class="px-6 py-4">Cerró tarea #452</td>
                            <td class="px-6 py-4 text-sena-green font-bold">Éxito ✓</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
