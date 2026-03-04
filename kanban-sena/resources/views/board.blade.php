<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl text-sena-gray900">Tablero Kanban</h2>
            <button class="bg-sena-green text-white px-4 py-2 rounded-md font-bold text-sm flex items-center hover:bg-sena-greenHover transition-all shadow-sm">
                <i class="bi bi-plus-lg mr-2"></i> Nueva Tarea
            </button>
        </div>
    </x-slot>

    <div class="flex space-x-6 overflow-x-auto pb-4 custom-scrollbar h-[calc(100vh-180px)]">
        <!-- Columna: Pendiente -->
        <div class="flex-shrink-0 w-80 flex flex-col h-full">
            <div class="bg-sena-gray100 px-4 py-3 rounded-t-lg flex justify-between items-center border-b border-sena-gray200">
                <h3 class="text-sm font-bold text-sena-gray700 uppercase tracking-widest flex items-center">
                    <span class="w-2 h-2 rounded-full bg-sena-gray400 mr-2"></span>
                    Pendiente
                </h3>
                <span class="text-[10px] font-bold bg-white text-sena-gray400 px-2 py-0.5 rounded-full shadow-sm">4</span>
            </div>
            <div id="column-pending" class="flex-1 bg-sena-gray50/50 p-3 rounded-b-lg space-y-3 overflow-y-auto kanban-column">
                <!-- Card 1 -->
                <div class="bg-white p-4 rounded-lg shadow-card border border-transparent hover:border-sena-green transition-all cursor-grab active:cursor-grabbing group">
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-[9px] font-bold text-sena-navy bg-sena-navyLight px-1.5 py-0.5 rounded uppercase">Infraestructura</span>
                        <div class="opacity-0 group-hover:opacity-100 transition-opacity">
                            <i class="bi bi-three-dots text-sena-gray400 cursor-pointer"></i>
                        </div>
                    </div>
                    <h4 class="text-sm font-semibold text-sena-gray900 mb-2">Actualizar servidor de base de datos</h4>
                    <p class="text-xs text-sena-gray400 line-clamp-2 mb-4">Migrar de MySQL 5.7 a 8.0 para mejorar el rendimiento.</p>
                    <div class="flex justify-between items-center">
                        <div class="flex -space-x-2">
                            <img src="https://ui-avatars.com/api/?name=AD&background=39A900&color=fff" class="w-6 h-6 rounded-full border-2 border-white" title="Admin">
                        </div>
                        <div class="flex items-center text-[10px] font-bold text-red-500">
                            <i class="bi bi-calendar-event mr-1"></i> 15 MAR
                        </div>
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="bg-white p-4 rounded-lg shadow-card border border-transparent hover:border-sena-green transition-all cursor-grab active:cursor-grabbing group">
                    <div class="flex justify-between items-start mb-2">
                        <span class="text-[9px] font-bold text-purple-600 bg-purple-50 px-1.5 py-0.5 rounded uppercase">UX/UI</span>
                    </div>
                    <h4 class="text-sm font-semibold text-sena-gray900 mb-2">Diseño de prototipo de reportes</h4>
                    <div class="flex justify-between items-center">
                        <i class="bi bi-paperclip text-sena-gray400 text-xs"> 2</i>
                        <img src="https://ui-avatars.com/api/?name=C&background=003770&color=fff" class="w-6 h-6 rounded-full border-2 border-white">
                    </div>
                </div>
            </div>
        </div>

        <!-- Columna: En Proceso -->
        <div class="flex-shrink-0 w-80 flex flex-col h-full">
            <div class="bg-blue-50 px-4 py-3 rounded-t-lg flex justify-between items-center border-b border-blue-100">
                <h3 class="text-sm font-bold text-blue-700 uppercase tracking-widest flex items-center">
                    <span class="w-2 h-2 rounded-full bg-blue-500 mr-2 animate-pulse"></span>
                    En Proceso
                </h3>
                <span class="text-[10px] font-bold bg-white text-blue-500 px-2 py-0.5 rounded-full shadow-sm">2</span>
            </div>
            <div id="column-progress" class="flex-1 bg-blue-50/20 p-3 rounded-b-lg space-y-3 overflow-y-auto kanban-column border-x border-b border-blue-50">
                <!-- Card 3 -->
                <div class="bg-white p-4 rounded-lg shadow-card border-l-4 border-blue-500 cursor-grab active:cursor-grabbing group">
                    <h4 class="text-sm font-semibold text-sena-gray900 mb-2">Implementación de RBAC</h4>
                    <div class="w-full bg-blue-50 rounded-full h-1 mb-4">
                        <div class="bg-blue-500 h-full rounded-full" style="width: 45%"></div>
                    </div>
                    <div class="flex justify-between items-center">
                         <span class="text-[10px] text-blue-600 font-bold italic">En desarrollo</span>
                         <img src="https://ui-avatars.com/api/?name=I&background=39A900&color=fff" class="w-6 h-6 rounded-full border-2 border-white">
                    </div>
                </div>
            </div>
        </div>

        <!-- Columna: Finalizado -->
        <div class="flex-shrink-0 w-80 flex flex-col h-full">
            <div class="bg-sena-greenLight px-4 py-3 rounded-t-lg flex justify-between items-center border-b border-sena-green/10">
                <h3 class="text-sm font-bold text-sena-green uppercase tracking-widest flex items-center">
                    <i class="bi bi-check-all mr-2 text-lg"></i>
                    Finalizado
                </h3>
                <span class="text-[10px] font-bold bg-white text-sena-green px-2 py-0.5 rounded-full shadow-sm">12</span>
            </div>
            <div id="column-done" class="flex-1 bg-sena-greenLight/10 p-3 rounded-b-lg space-y-3 overflow-y-auto kanban-column border-x border-b border-sena-green/5">
                <!-- Card 4 -->
                <div class="bg-white p-4 rounded-lg shadow-card opacity-70 hover:opacity-100 transition-opacity cursor-grab active:cursor-grabbing group line-through text-sena-gray400">
                    <h4 class="text-sm font-semibold mb-2">Setup inicial de Laravel Breeze</h4>
                    <div class="flex justify-end">
                        <i class="bi bi-check-circle-fill text-sena-green"></i>
                    </div>
                </div>
            </div>
        </div>

        <!-- Botón: Nueva Columna -->
        <button class="flex-shrink-0 w-12 h-12 bg-white rounded-lg shadow-card flex items-center justify-center text-sena-gray400 hover:text-sena-navy border-2 border-dashed border-sena-gray100 hover:border-sena-navy transition-all">
            <i class="bi bi-plus-lg text-xl"></i>
        </button>
    </div>

    <!-- Scripts for Drag and Drop -->
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const columns = ['column-pending', 'column-progress', 'column-done'];
            
            columns.forEach(id => {
                new Sortable(document.getElementById(id), {
                    group: 'kanban',
                    animation: 150,
                    ghostClass: 'bg-sena-greenLight',
                    chosenClass: 'scale-[1.02]',
                    dragClass: 'shadow-2xl',
                    onEnd: function (evt) {
                        const taskId = evt.item.dataset.id;
                        const toColumn = evt.to.id;
                        console.log(`Tarea movida a: ${toColumn}`);
                        // Aquí se dispararía una petición AJAX al servidor en el futuro
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
