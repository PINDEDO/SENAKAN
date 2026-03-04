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
                    <h3 class="text-3xl font-bold text-sena-gray900 mt-1">{{ $metrics['total_tasks'] ?? 0 }}</h3>
                </div>
                <div class="p-2 bg-sena-navyLight rounded-lg text-sena-navy">
                    <i class="bi bi-list-task text-xl"></i>
                </div>
            </div>
            <p class="text-[11px] text-green-600 mt-4 flex items-center font-medium">
                <i class="bi bi-arrow-up-short text-lg"></i> +3 esta semana
            </p>
        </div>

        <!-- En Progreso -->
        <div class="bg-white rounded-lg shadow-card p-5 border-l-4 border-blue-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-sena-gray400 uppercase tracking-widest">En Progreso</p>
                    <h3 class="text-3xl font-bold text-sena-gray900 mt-1">{{ $metrics['pending_tasks'] ?? 0 }}</h3>
                </div>
                <div class="p-2 bg-blue-50 rounded-lg text-blue-500">
                    <i class="bi bi-hourglass-split text-xl"></i>
                </div>
            </div>
            <p class="text-[11px] text-sena-gray400 mt-4">Actualizado hace 5 min</p>
        </div>

        <!-- Vencidas -->
        <div class="bg-white rounded-lg shadow-card p-5 border-l-4 border-red-500">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-sena-gray400 uppercase tracking-widest">Vencidas</p>
                    <h3 class="text-3xl font-bold text-red-600 mt-1">{{ $metrics['overdue_tasks'] ?? 0 }}</h3>
                </div>
                <div class="p-2 bg-red-50 rounded-lg text-red-500">
                    <i class="bi bi-exclamation-triangle text-xl"></i>
                </div>
            </div>
            <p class="text-[11px] text-red-400 mt-4 font-medium flex items-center">
                <i class="bi bi-alarm mr-1"></i> Acción prioritaria
            </p>
        </div>

        <!-- Completadas -->
        <div class="bg-white rounded-lg shadow-card p-5 border-l-4 border-sena-green">
            <div class="flex justify-between items-start">
                <div>
                    <p class="text-xs font-bold text-sena-gray400 uppercase tracking-widest">Completadas</p>
                    <h3 class="text-3xl font-bold text-sena-green mt-1">{{ $metrics['completed_tasks'] ?? 0 }}</h3>
                </div>
                <div class="p-2 bg-sena-greenLight rounded-lg text-sena-green">
                    <i class="bi bi-check2-circle text-xl"></i>
                </div>
            </div>
            <p class="text-[11px] text-sena-green mt-4 font-medium flex items-center">
                <i class="bi bi-patch-check mr-1"></i> 85% de cumplimiento
            </p>
        </div>
    </div>

    <!-- Main Content Grid (64% / 36%) -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <!-- Mis Tareas Pendientes -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-card overflow-hidden h-full flex flex-col">
                <div class="px-6 py-4 border-b border-sena-gray100 flex justify-between items-center bg-white sticky top-0 z-10">
                    <h3 class="font-bold text-sena-gray900">Mis Tareas Pendientes</h3>
                    <span class="bg-sena-navy text-white text-[10px] font-bold px-2 py-0.5 rounded-full uppercase tracking-tighter">12 Pendientes</span>
                </div>
                <div class="flex-1 overflow-y-auto custom-scrollbar bg-white">
                    @forelse($recent_tasks ?? [] as $task)
                        <div class="p-4 border-b border-sena-gray50 last:border-0 hover:bg-sena-gray50 transition-colors cursor-pointer group">
                            <div class="flex justify-between items-start mb-2">
                                <div class="flex items-center space-x-3">
                                    <span class="w-2.5 h-2.5 rounded-full bg-red-500 shadow-sm shadow-red-200"></span>
                                    <h4 class="text-sm font-semibold text-sena-gray700 group-hover:text-sena-navy transition-colors">
                                        {{ $task->title }}
                                    </h4>
                                </div>
                                <span class="text-[10px] font-bold text-red-500 bg-red-50 px-2 py-0.5 rounded uppercase">Vence Hoy</span>
                            </div>
                            <div class="flex items-center justify-between ml-5.5">
                                <div class="flex items-center space-x-4">
                                    <div class="flex items-center text-xs text-sena-gray400">
                                        <i class="bi bi-folder2-open mr-1.5 text-xs"></i>
                                        <span>Proyect: Sistema Alertas</span>
                                    </div>
                                    <div class="flex items-center text-xs text-sena-gray400">
                                        <i class="bi bi-columns-gap mr-1.5 text-xs"></i>
                                        <span class="font-medium">En Progreso</span>
                                    </div>
                                </div>
                                <div class="flex -space-x-2">
                                    <img src="https://ui-avatars.com/api/?name=User&background=003770&color=fff" class="w-6 h-6 rounded-full border-2 border-white">
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="p-16 text-center">
                            <div class="inline-flex items-center justify-center w-20 h-20 bg-sena-gray50 rounded-full mb-6">
                                <i class="bi bi-emoji-smile text-4xl text-sena-gray200"></i>
                            </div>
                            <h4 class="text-sena-gray700 font-bold text-lg">¡Todo al día!</h4>
                            <p class="text-sm text-sena-gray400 max-w-xs mx-auto mt-2">No tienes tareas urgentes asignadas en este momento.</p>
                            <button class="mt-8 text-sena-navy font-bold text-sm hover:underline">Ver todas mis tareas</button>
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
                    <div class="group cursor-pointer">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h4 class="text-sm font-bold text-sena-gray900 group-hover:text-sena-green transition-colors">Plataforma Educativa</h4>
                                <p class="text-[10px] uppercase font-bold text-sena-gray400 tracking-widest mt-0.5">Ficha: #287465</p>
                            </div>
                            <span class="text-xs font-bold text-sena-green bg-sena-greenLight px-2 py-0.5 rounded">65%</span>
                        </div>
                        <div class="w-full bg-sena-gray100 rounded-full h-2 overflow-hidden">
                            <div class="bg-gradient-to-r from-sena-green to-green-400 h-full rounded-full transition-all duration-1000 ease-out shadow-sm" style="width: 65%"></div>
                        </div>
                        <div class="flex justify-between mt-2">
                            <span class="text-[10px] text-sena-gray400 font-medium">24 de 36 completadas</span>
                            <span class="text-[10px] text-sena-navy font-bold group-hover:underline">Detalles →</span>
                        </div>
                    </div>

                    <div class="group cursor-pointer">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h4 class="text-sm font-bold text-sena-gray900 group-hover:text-sena-green transition-colors">App de Bienestar</h4>
                                <p class="text-[10px] uppercase font-bold text-sena-gray400 tracking-widest mt-0.5">Ficha: #287466</p>
                            </div>
                            <span class="text-xs font-bold text-sena-green bg-sena-greenLight px-2 py-0.5 rounded">20%</span>
                        </div>
                        <div class="w-full bg-sena-gray100 rounded-full h-2 overflow-hidden">
                            <div class="bg-gradient-to-r from-sena-green to-green-400 h-full rounded-full transition-all duration-1000 ease-out shadow-sm" style="width: 20%"></div>
                        </div>
                        <div class="flex justify-between mt-2">
                            <span class="text-[10px] text-sena-gray400 font-medium">5 de 25 completadas</span>
                            <span class="text-[10px] text-sena-navy font-bold group-hover:underline">Detalles →</span>
                        </div>
                    </div>

                    <div class="group cursor-pointer">
                        <div class="flex justify-between items-start mb-3">
                            <div>
                                <h4 class="text-sm font-bold text-sena-gray900 group-hover:text-sena-green transition-colors">Sistema Seguimiento</h4>
                                <p class="text-[10px] uppercase font-bold text-sena-gray400 tracking-widest mt-0.5">Ficha: #287467</p>
                            </div>
                            <span class="text-xs font-bold text-sena-green bg-sena-greenLight px-2 py-0.5 rounded">90%</span>
                        </div>
                        <div class="w-full bg-sena-gray100 rounded-full h-2 overflow-hidden">
                            <div class="bg-gradient-to-r from-sena-green to-green-400 h-full rounded-full transition-all duration-1000 ease-out shadow-sm" style="width: 90%"></div>
                        </div>
                        <div class="flex justify-between mt-2">
                            <span class="text-[10px] text-sena-gray400 font-medium">18 de 20 completadas</span>
                            <span class="text-[10px] text-sena-navy font-bold group-hover:underline">Detalles →</span>
                        </div>
                    </div>

                    <button class="w-full bg-sena-gray50 text-sena-navy text-xs font-bold py-3 rounded-lg hover:bg-sena-navyLight transition-colors mt-4">
                        Ver todos los proyectos institucionales
                    </button>
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
