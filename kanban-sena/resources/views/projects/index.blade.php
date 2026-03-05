<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl text-sena-gray900">Proyectos de Formación</h2>
            @if(auth()->user()->isAdmin() || auth()->user()->isCoordinador())
            <button onclick="document.getElementById('modal-create').classList.remove('hidden')" class="bg-sena-navy text-white px-4 py-2 rounded-md font-bold text-sm flex items-center hover:bg-sena-navyLight transition-all">
                <i class="bi bi-folder-plus mr-2"></i> Nuevo Proyecto
            </button>
            @endif
        </div>
    </x-slot>

    @if(session('success'))
        <div class="mb-6 p-4 bg-sena-greenLight border-l-4 border-sena-green text-sena-greenHover font-bold text-sm rounded shadow-sm">
            {{ session('success') }}
        </div>
    @endif

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($projects as $project)
            <div class="bg-white rounded-lg shadow-card overflow-hidden border-t-4" style="border-top-color: {{ $project->color }}">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <div>
                            <span class="text-[10px] font-bold text-sena-gray400 uppercase tracking-widest">Ficha: {{ $project->code }}</span>
                            <h3 class="text-lg font-bold text-sena-gray900 mt-1">{{ $project->name }}</h3>
                        </div>
                        <span class="px-2 py-0.5 rounded-full text-[10px] font-bold uppercase {{ $project->status === 'active' ? 'bg-sena-greenLight text-sena-green' : 'bg-sena-gray100 text-sena-gray400' }}">
                            {{ $project->status }}
                        </span>
                    </div>
                    
                    <p class="text-sm text-sena-gray700 line-clamp-2 mb-6 h-10">
                        {{ $project->description ?: 'Sin descripción disponible.' }}
                    </p>

                    <div class="flex justify-between items-center pt-4 border-t border-sena-gray50">
                        <div class="flex items-center text-sena-gray400 text-xs">
                            <i class="bi bi-list-task mr-1.5"></i>
                            <span class="font-bold">{{ $project->tasks_count }}</span>
                            <span class="ml-1">Tareas</span>
                        </div>
                        <div class="flex space-x-2">
                             <a href="{{ route('board.index') }}?project_id={{ $project->id }}" class="text-sena-navy hover:text-sena-navyLight font-bold text-xs">Ver Tablero →</a>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full bg-white p-12 rounded-lg shadow-card text-center">
                <i class="bi bi-folder2-open text-5xl text-sena-gray100 mb-4 block"></i>
                <h3 class="text-lg font-bold text-sena-gray700">No hay proyectos registrados</h3>
                <p class="text-sm text-sena-gray400 mt-2">Comienza creando un nuevo proyecto de formación.</p>
            </div>
        @endforelse
    </div>

    <!-- Modal Create Example (Minimal for now) -->
    <div id="modal-create" class="fixed inset-0 bg-sena-navy/50 backdrop-blur-sm z-50 flex items-center justify-center p-4 hidden">
        <div class="bg-white rounded-lg shadow-2xl w-full max-w-md overflow-hidden">
            <div class="px-6 py-4 border-b border-sena-gray100 bg-sena-gray50 flex justify-between items-center">
                <h3 class="font-bold text-sena-navy">Nuevo Proyecto de Formación</h3>
                <button onclick="document.getElementById('modal-create').classList.add('hidden')" class="text-sena-gray400 hover:text-sena-gray900">
                    <i class="bi bi-x-lg"></i>
                </button>
            </div>
            <form action="{{ route('projects.store') }}" method="POST" class="p-6 space-y-4">
                @csrf
                <div>
                    <label class="block text-xs font-bold text-sena-gray400 uppercase mb-1">Nombre del Proyecto</label>
                    <input type="text" name="name" required class="w-full border-sena-gray200 rounded-md text-sm focus:border-sena-green outline-none p-2 translate-all">
                </div>
                <div>
                    <label class="block text-xs font-bold text-sena-gray400 uppercase mb-1">Número de Ficha</label>
                    <input type="text" name="code" required class="w-full border-sena-gray200 rounded-md text-sm focus:border-sena-green outline-none p-2 translate-all">
                </div>
                <div>
                    <label class="block text-xs font-bold text-sena-gray400 uppercase mb-1">Descripción</label>
                    <textarea name="description" rows="3" class="w-full border-sena-gray200 rounded-md text-sm focus:border-sena-green outline-none p-2 translate-all"></textarea>
                </div>
                <div class="flex justify-end space-x-3 pt-4">
                    <button type="button" onclick="document.getElementById('modal-create').classList.add('hidden')" class="px-4 py-2 text-sm font-bold text-sena-gray400 hover:text-sena-gray700">Cancelar</button>
                    <button type="submit" class="bg-sena-green text-white px-6 py-2 rounded-md font-bold text-sm hover:bg-sena-greenHover shadow-md">Crear Proyecto</button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
