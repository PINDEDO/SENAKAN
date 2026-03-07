<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-xl text-sena-gray900">Gestión de Usuarios</h2>
            <button onclick="openUserModal()" class="bg-sena-navy text-white px-4 py-2 rounded-md font-bold text-sm flex items-center hover:bg-sena-navyLight transition-all">
                <i class="bi bi-person-plus mr-2"></i> Nuevo Usuario
            </button>
        </div>
    </x-slot>

    <div class="bg-white rounded-lg shadow-card overflow-hidden">
        <!-- ... (filters section same as before) ... -->
        
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
                                        <div class="w-10 h-10 rounded-full bg-sena-navy text-white flex items-center justify-center font-bold">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
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
                                    {{ $user->role === 'funcionario' ? 'bg-blue-50 text-blue-600' : '' }}
                                ">
                                    {{ ucfirst($user->role) }}
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
                                    <button onclick="editUser({{ json_encode($user) }})" class="p-1.5 text-sena-gray400 hover:text-sena-navy hover:bg-sena-navyLight rounded transition-all">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <form action="{{ route('users.destroy', $user) }}" method="POST" id="delete-user-{{ $user->id }}" class="hidden">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                    <button onclick="confirmDelete('{{ $user->id }}', '{{ $user->name }}')" class="p-1.5 text-sena-gray400 hover:text-red-600 hover:bg-red-50 rounded transition-all" title="Eliminar">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal: Usuario -->
    <div id="userModal" class="fixed inset-0 z-50 hidden">
        <div class="absolute inset-0 bg-sena-navy/60 backdrop-blur-sm"></div>
        <div class="flex items-center justify-center min-h-screen p-4">
            <div class="bg-white rounded-lg shadow-xl w-full max-w-md relative animate-in fade-in zoom-in duration-200">
                <div class="px-6 py-4 border-b border-sena-gray100 flex justify-between items-center">
                    <h3 id="modalUserTitle" class="font-bold text-sena-navy">Nuevo Usuario</h3>
                    <button onclick="closeUserModal()" class="text-sena-gray400 hover:text-sena-gray600">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>
                <form id="userForm" method="POST" class="p-6 space-y-4">
                    @csrf
                    <input type="hidden" name="_method" id="userFormMethod" value="POST">
                    
                    <div>
                        <label class="block text-xs font-bold text-sena-gray700 uppercase mb-1">Nombre Completo</label>
                        <input type="text" name="name" id="userName" required class="w-full border-sena-gray200 rounded-md focus:border-sena-green focus:ring-sena-greenLight text-sm" placeholder="Ej: Juan Pérez">
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-sena-gray700 uppercase mb-1">Correo Institucional</label>
                        <input type="email" name="email" id="userEmail" required class="w-full border-sena-gray200 rounded-md focus:border-sena-green focus:ring-sena-greenLight text-sm" placeholder="usuario@sena.edu.co">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-sena-gray700 uppercase mb-1">Contraseña</label>
                            <input type="password" name="password" id="userPassword" class="w-full border-sena-gray200 rounded-md focus:border-sena-green focus:ring-sena-greenLight text-sm" placeholder="Mínimo 8 caracteres">
                        </div>
                        <div>
                            <label class="block text-xs font-bold text-sena-gray700 uppercase mb-1">Confirmar Contraseña</label>
                            <input type="password" name="password_confirmation" id="userPasswordConfirm" class="w-full border-sena-gray200 rounded-md focus:border-sena-green focus:ring-sena-greenLight text-sm" placeholder="Repetir contraseña">
                        </div>
                    </div>
                    <p class="text-[10px] text-sena-gray400" id="passwordHint">Dejar en blanco para mantener la actual (en edición)</p>
                    
                    <div class="grid grid-cols-2 gap-4">
                        <div>
                            <label class="block text-xs font-bold text-sena-gray700 uppercase mb-1">Rol</label>
                            <select name="role" id="userRole" required class="w-full border-sena-gray200 rounded-md focus:border-sena-green focus:ring-sena-greenLight text-sm">
                                @if(auth()->user()->isAdmin())
                                    <option value="admin">Administrador</option>
                                @endif
                                <option value="coordinador">Coordinador</option>
                                <option value="instructor">Instructor</option>
                                <option value="funcionario" selected>Funcionario</option>
                            </select>
                        </div>
                        <div class="flex items-center pt-5">
                            <label class="inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="active" id="userActive" checked class="sr-only peer">
                                <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-sena-green"></div>
                                <span class="ms-3 text-xs font-bold text-sena-gray700">ACTIVO</span>
                            </label>
                        </div>
                    </div>
                    <div class="pt-4">
                        <button type="submit" class="w-full bg-sena-green text-white font-bold py-2 rounded-md hover:bg-sena-greenHover transition-all shadow-md">
                            Guardar Usuario
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openUserModal() {
            document.getElementById('modalUserTitle').textContent = 'Nuevo Usuario';
            document.getElementById('userForm').action = "{{ route('users.store') }}";
            document.getElementById('userFormMethod').value = "POST";
            document.getElementById('userName').value = '';
            document.getElementById('userEmail').value = '';
            document.getElementById('userPassword').required = true;
            document.getElementById('userPassword').value = '';
            document.getElementById('userPasswordConfirm').required = true;
            document.getElementById('userPasswordConfirm').value = '';
            document.getElementById('passwordHint').classList.add('hidden');
            document.getElementById('userRole').value = 'funcionario';
            document.getElementById('userActive').checked = true;
            document.getElementById('userModal').classList.remove('hidden');
        }

        function editUser(user) {
            document.getElementById('modalUserTitle').textContent = 'Editar Usuario';
            document.getElementById('userForm').action = `/admin/users/${user.id}`;
            document.getElementById('userFormMethod').value = "PUT";
            document.getElementById('userName').value = user.name;
            document.getElementById('userEmail').value = user.email;
            document.getElementById('userPassword').required = false;
            document.getElementById('userPassword').value = '';
            document.getElementById('userPasswordConfirm').required = false;
            document.getElementById('userPasswordConfirm').value = '';
            document.getElementById('passwordHint').classList.remove('hidden');
            document.getElementById('userRole').value = user.role;
            document.getElementById('userActive').checked = user.active == 1;
            document.getElementById('userModal').classList.remove('hidden');
        }

        function closeUserModal() {
            document.getElementById('userModal').classList.add('hidden');
        }

        document.getElementById('userForm').addEventListener('submit', function(e) {
            const name = document.getElementById('userName').value;
            const email = document.getElementById('userEmail').value;
            
            if (!name || !email) {
                e.preventDefault();
                Swal.fire({
                    icon: 'warning',
                    title: 'Campos Incompletos',
                    text: 'El nombre y el correo electrónico son obligatorios para gestionar usuarios.',
                    confirmButtonColor: '#39A900'
                });
            }
        });

        function confirmDelete(userId, userName) {
            Swal.fire({
                title: '¿Estás seguro?',
                text: `Deseas eliminar al usuario ${userName}. Esta acción no se puede deshacer.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#DC2626',
                cancelButtonColor: '#8E9BAA',
                confirmButtonText: 'Sí, eliminar',
                cancelButtonText: 'Cancelar',
                background: '#FFFFFF',
                color: '#1A2533',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById(`delete-user-${userId}`).submit();
                }
            })
        }
    </script>
</x-app-layout>
