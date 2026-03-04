<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl text-sena-gray900">Gestión de Usuarios</h2>
            <button class="bg-sena-navy text-white px-4 py-2 rounded-md font-bold text-sm flex items-center hover:bg-sena-navyLight transition-all">
                <i class="bi bi-person-plus mr-2"></i> Nuevo Usuario
            </button>
        </div>
    </x-slot>

    <div class="bg-white rounded-lg shadow-card overflow-hidden">
        <div class="px-6 py-4 border-b border-sena-gray100 bg-sena-gray50/50 flex justify-between items-center">
            <div class="flex items-center space-x-4">
                <div class="relative">
                    <input type="text" placeholder="Buscar por nombre o correo..." 
                        class="pl-10 pr-4 py-2 border border-sena-gray200 rounded-md text-sm outline-none focus:border-sena-green transition-all w-64">
                    <i class="bi bi-search absolute left-3 top-2.5 text-sena-gray400"></i>
                </div>
                <select class="border border-sena-gray200 rounded-md text-sm py-2 px-3 outline-none focus:border-sena-green">
                    <option value="">Todos los Roles</option>
                    <option value="admin">Administrador</option>
                    <option value="coordinador">Coordinador</option>
                    <option value="instructor">Instructor</option>
                    <option value="aprendiz">Aprendiz</option>
                </select>
            </div>
            <span class="text-xs text-sena-gray400 font-medium">Total: {{ $users->count() }} usuarios</span>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left">
                <thead>
                    <tr class="bg-sena-gray50 border-b border-sena-gray100 text-[10px] uppercase font-bold text-sena-gray400 tracking-widest">
                        <th class="px-6 py-4">Usuario</th>
                        <th class="px-6 py-4 text-center">Rol</th>
                        <th class="px-6 py-4 text-center">Estado</th>
                        <th class="px-6 py-4 text-center">Último Acceso</th>
                        <th class="px-6 py-4 text-right">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-sena-gray50">
                    @foreach($users as $user)
                        <tr class="hover:bg-sena-gray50/50 transition-colors group">
                            <td class="px-6 py-4">
                                <div class="flex items-center space-x-3">
                                    <div class="relative">
                                        <img src="{{ $user->avatar_url }}" class="w-10 h-10 rounded-full border-2 border-white shadow-sm">
                                        @if($user->active)
                                            <span class="absolute bottom-0 right-0 w-3 h-3 bg-sena-green border-2 border-white rounded-full"></span>
                                        @endif
                                    </div>
                                    <div>
                                        <p class="text-sm font-bold text-sena-gray900">{{ $user->name }}</p>
                                        <p class="text-xs text-sena-gray400">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="px-2.5 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                                    {{ $user->role === 'admin' ? 'bg-red-50 text-red-600' : '' }}
                                    {{ $user->role === 'coordinador' ? 'bg-sena-navyLight text-sena-navy' : '' }}
                                    {{ $user->role === 'instructor' ? 'bg-sena-greenLight text-sena-green' : '' }}
                                    {{ $user->role === 'aprendiz' ? 'bg-sena-gray100 text-sena-gray400' : '' }}
                                ">
                                    {{ $user->role }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <div class="flex justify-center">
                                    @if($user->active)
                                        <span class="flex items-center text-xs font-medium text-sena-green">
                                            <i class="bi bi-check-circle-fill mr-1"></i> Activo
                                        </span>
                                    @else
                                        <span class="flex items-center text-xs font-medium text-sena-gray400">
                                            <i class="bi bi-dash-circle mr-1"></i> Inactivo
                                        </span>
                                    @endif
                                </div>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <span class="text-xs text-sena-gray900 font-medium">
                                    {{ $user->last_login ? $user->last_login->diffForHumans() : 'Nunca' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-right">
                                <div class="flex justify-end space-x-2">
                                    <button class="p-1.5 text-sena-gray400 hover:text-sena-navy hover:bg-sena-navyLight rounded transition-all">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <button class="p-1.5 text-sena-gray400 hover:text-red-600 hover:bg-red-50 rounded transition-all" title="Eliminar">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        
        <div class="px-6 py-4 border-t border-sena-gray100 bg-sena-gray50/30 flex justify-between items-center">
            <p class="text-[11px] text-sena-gray400">Mostrando {{ $users->count() }} de {{ $users->count() }} registros</p>
            <div class="flex space-x-1">
                <button class="px-3 py-1 border border-sena-gray200 rounded text-xs text-sena-gray400 hover:bg-white transition-all disabled:opacity-50" disabled>Ant.</button>
                <button class="px-3 py-1 bg-sena-navy text-white rounded text-xs font-bold transition-all shadow-sm">1</button>
                <button class="px-3 py-1 border border-sena-gray200 rounded text-xs text-sena-gray400 hover:bg-white transition-all">Sig.</button>
            </div>
        </div>
    </div>
</x-app-layout>
