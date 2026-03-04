<!-- Sidebar -->
<aside class="w-sidebar bg-sena-navy text-white flex flex-col shrink-0 h-screen transition-all duration-300 shadow-sidebar z-30">
    <!-- Header/Logo -->
    <div class="h-16 flex items-center px-6 border-b border-white/10">
        <div class="flex items-center space-x-3">
            <svg width="32" height="32" viewBox="0 0 100 100" fill="white">
                <circle cx="50" cy="50" r="45" stroke="white" stroke-width="5" fill="none"/>
                <circle cx="50" cy="35" r="15"/>
                <path d="M25 80C25 66.1929 36.1929 55 50 55C63.8071 55 75 66.1929 75 80V85H25V80Z"/>
            </svg>
            <span class="text-lg font-bold tracking-tight">KanbanSENA</span>
        </div>
    </div>

    <!-- Perfil resumido -->
    <div class="px-6 py-8 border-b border-white/5">
        <div class="flex items-center space-x-3">
            <img src="{{ auth()->user()->avatar_url }}" alt="avatar" class="w-10 h-10 rounded-full border-2 border-sena-green">
            <div class="overflow-hidden">
                <p class="text-sm font-semibold truncate">{{ auth()->user()->name }}</p>
                <span class="inline-block px-2 py-0.5 mt-1 text-[10px] font-bold uppercase bg-sena-green text-white rounded-full">
                    {{ auth()->user()->role }}
                </span>
            </div>
        </div>
    </div>

    <!-- Navegación -->
    <nav class="flex-1 px-4 py-6 space-y-2 overflow-y-auto custom-scrollbar">
        <x-sidebar-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" icon="speedometer2">
            Dashboard
        </x-sidebar-link>

        @if(auth()->user()->isAdmin() || auth()->user()->isCoordinador())
            <div class="pt-4 pb-2 px-2">
                <p class="text-[10px] font-bold text-white/40 uppercase tracking-widest">Gestión</p>
            </div>
            
            <x-sidebar-link :href="route('board.index')" :active="request()->routeIs('board.index')" icon="columns-gap">
                Tablero Kanban
            </x-sidebar-link>
            
            <x-sidebar-link :href="route('users.index')" :active="request()->routeIs('users.index')" icon="people">
                Usuarios
            </x-sidebar-link>
            
            <x-sidebar-link :href="route('reports.index')" :active="request()->routeIs('reports.index')" icon="graph-up">
                Reportes
            </x-sidebar-link>
        @endif

        <div class="pt-4 pb-2 px-2">
            <p class="text-[10px] font-bold text-white/40 uppercase tracking-widest">Personal</p>
        </div>

        <x-sidebar-link href="#" icon="card-checklist">
            Mis Tareas
        </x-sidebar-link>

        <x-sidebar-link :href="route('profile.edit')" :active="request()->routeIs('profile.edit')" icon="gear">
            Configuración
        </x-sidebar-link>
    </nav>

    <!-- Logout -->
    <div class="p-4 border-t border-white/5 service-footer">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="w-full flex items-center space-x-3 px-4 py-3 text-white/70 hover:text-white hover:bg-white/10 rounded-md transition-all group">
                <svg class="w-5 h-5 text-red-400 group-hover:text-red-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                </svg>
                <span class="text-sm font-medium">Cerrar Sesión</span>
            </button>
        </form>
    </div>
</aside>
