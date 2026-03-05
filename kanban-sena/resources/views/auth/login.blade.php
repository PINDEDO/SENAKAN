<x-guest-layout>
    <div class="flex min-h-screen flex-col lg:flex-row">
        <!-- Columna Izquierda (40% Desktop) -->
        <div class="hidden lg:flex lg:w-[40%] bg-gradient-to-b from-sena-navy to-blue-900 flex-col items-center justify-center p-12 text-center text-white">
            <!-- Logo SENA Blanco -->
            <div class="mb-8">
                <svg width="120" height="120" viewBox="0 0 100 100" fill="white" xmlns="http://www.w3.org/2000/svg">
                    <circle cx="50" cy="50" r="45" stroke="white" stroke-width="2" fill="none"/>
                    <circle cx="50" cy="35" r="12" fill="white"/>
                    <path d="M30 75C30 63.9543 38.9543 55 50 55C61.0457 55 70 63.9543 70 75V85H30V75Z" fill="white"/>
                </svg>
            </div>
            <h1 class="text-3xl font-bold mb-4">KanbanSENA</h1>
            <p class="text-white/80 text-lg italic tracking-wide">"Gestión de Tareas Institucional"</p>
            
            <!-- Ilustración abstracta -->
            <div class="mt-20 opacity-20 pointer-events-none">
                <div class="flex items-end space-x-4">
                    <div class="w-20 h-32 bg-white rounded-lg"></div>
                    <div class="w-20 h-48 bg-white rounded-lg"></div>
                    <div class="w-20 h-24 bg-white rounded-lg"></div>
                </div>
            </div>
        </div>

        <!-- Columna Derecha (60% Desktop / 100% Mobile) -->
        <div class="flex-1 bg-white flex items-center justify-center p-8 lg:p-24 relative">
            <div class="w-full max-w-[400px]">
                <!-- Logo Mobile (Solamente visible en pantallas pequeñas) -->
                <div class="lg:hidden flex flex-col items-center mb-10 text-sena-navy">
                    <svg width="64" height="64" viewBox="0 0 100 100" fill="currentColor">
                        <circle cx="50" cy="50" r="45" stroke="currentColor" stroke-width="5" fill="none"/>
                        <circle cx="50" cy="35" r="15"/>
                        <path d="M25 80C25 66.1929 36.1929 55 50 55C63.8071 55 75 66.1929 75 80V85H25V80Z"/>
                    </svg>
                    <h1 class="text-2xl font-bold mt-2">KanbanSENA</h1>
                </div>

                <div class="mb-10 text-center lg:text-left">
                    <h2 class="text-2xl font-bold text-sena-navy tracking-tight">Bienvenido</h2>
                    <p class="text-sm text-sena-gray400 mt-2">Ingresa con tu cuenta institucional</p>
                </div>

                <!-- Session Status -->
                <x-auth-session-status class="mb-6" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-sena-gray700 mb-1.5">Correo electrónico</label>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-sena-gray400 group-focus-within:text-sena-green transition-colors">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.206" />
                                </svg>
                            </div>
                            <input id="email" type="email" name="email" value="{{ old('email') }}" required autofocus
                                class="w-full pl-11 pr-4 py-2.5 bg-white border border-sena-gray200 rounded-md outline-none focus:border-sena-green focus:ring-4 focus:ring-sena-greenLight/50 transition-all duration-200 text-sena-gray900 placeholder:text-sena-gray400"
                                placeholder="usuario@sena.edu.co">
                        </div>
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="password" class="block text-sm font-medium text-sena-gray700">Contraseña</label>
                            @if (Route::has('password.request'))
                                <a class="text-xs text-sena-navy hover:underline font-semibold" href="{{ route('password.request') }}">
                                    ¿Olvidaste tu contraseña?
                                </a>
                            @endif
                        </div>
                        <div class="relative group">
                            <div class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-sena-gray400 group-focus-within:text-sena-green transition-colors">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                </svg>
                            </div>
                            <input id="password" type="password" name="password" required
                                class="w-full pl-11 pr-11 py-2.5 bg-white border border-sena-gray200 rounded-md outline-none focus:border-sena-green focus:ring-4 focus:ring-sena-greenLight/50 transition-all duration-200 text-sena-gray900 placeholder:text-sena-gray400"
                                placeholder="••••••••">
                            <button type="button" class="absolute inset-y-0 right-0 pr-3.5 flex items-center text-sena-gray400 hover:text-sena-gray600 transition-colors">
                                <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                            </button>
                        </div>
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center">
                        <input id="remember_me" type="checkbox" name="remember" 
                            class="rounded border-sena-gray200 text-sena-green focus:ring-sena-greenLight cursor-pointer">
                        <label for="remember_me" class="ml-2 block text-sm text-sena-gray400 cursor-pointer select-none">Recordar sesión</label>
                    </div>

                    <!-- Submit Button -->
                    <div class="pt-2">
                        <button type="submit" 
                            class="w-full h-[48px] bg-sena-green text-white font-bold rounded-md hover:bg-sena-greenHover shadow-lg shadow-sena-greenLight active:scale-[0.98] transition-all duration-150 flex items-center justify-center">
                            <span>Ingresar</span>
                        </button>
                    </div>
                </form>

                <!-- Footer -->
                <div class="mt-16 pt-8 border-t border-sena-gray100 text-center">
                    <p class="text-[11px] text-sena-gray400 uppercase font-bold tracking-[0.1em] mb-1">Entorno Administrativo</p>
                    <p class="text-[10px] text-sena-gray400 italic">v1.0.0 — SENA 2026</p>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>
