<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear Cuenta - {{ config('app.name', 'TicketPro') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: {
                        brand: { 400: '#818cf8', 500: '#6366f1', 600: '#4f46e5', 700: '#4338ca' }
                    }
                }
            }
        }
    </script>
</head>
<body class="font-sans antialiased bg-gray-950 text-gray-300 selection:bg-brand-500 selection:text-white min-h-screen flex">

    <!-- Navbar (Logo) -->
    <div class="absolute top-0 left-0 w-full p-6 sm:p-10 z-50 flex justify-between items-center">
        <a href="/" class="flex items-center gap-2 text-white font-black text-xl tracking-tighter hover:text-gray-300 transition-colors">
            <svg class="w-7 h-7 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
            </svg>
            TICKET<span class="text-brand-500">PRO</span>
        </a>
    </div>

    <!-- Main Layout: 2 Columns -->
    <main class="w-full flex">

        <!-- Columna Izquierda: Mensaje y Visual (Oculto en móvil) -->
        <div class="hidden lg:flex flex-col justify-center w-1/2 p-16 xl:p-24 relative overflow-hidden bg-gray-900 border-r border-gray-800">
            <!-- Background effects -->
            <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-brand-600/20 rounded-full blur-[120px] mix-blend-screen pointer-events-none"></div>
            <div class="absolute bottom-0 right-0 w-[400px] h-[400px] bg-blue-600/10 rounded-full blur-[100px] mix-blend-screen pointer-events-none"></div>
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')] opacity-30"></div>

            <div class="relative z-10 max-w-lg">
                <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-gray-950 border border-gray-800 text-brand-400 font-bold text-xs mb-8 shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
                    </svg>
                    Registro de Nueva Cuenta
                </div>

                <h1 class="text-4xl xl:text-5xl font-black text-white leading-tight mb-6">
                    Únete a la red de <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-400 to-blue-500">soporte profesional.</span>
                </h1>

                <p class="text-lg text-gray-400 mb-12 leading-relaxed font-light">
                    Crea tu cuenta y accede a la plataforma para gestionar solicitudes, comunicarte con el equipo y hacer seguimiento de tus incidencias en tiempo real.
                </p>

                <!-- Mini feature list -->
                <div class="space-y-4">
                    @foreach([
                        ['Acceso inmediato al panel de tickets', 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                        ['Comunicación directa con soporte', 'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z'],
                        ['Historial completo de incidencias', 'M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2'],
                    ] as [$label, $icon])
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-brand-600/10 border border-brand-500/20 flex items-center justify-center text-brand-400 shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $icon }}"/>
                            </svg>
                        </div>
                        <span class="text-sm font-medium text-gray-300">{{ $label }}</span>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        <!-- Columna Derecha: Formulario -->
        <div class="w-full lg:w-1/2 flex items-center justify-center p-6 sm:p-12 relative overflow-hidden bg-gray-950">

            <!-- Mobile bg effects -->
            <div class="lg:hidden absolute top-0 right-0 w-[400px] h-[400px] bg-brand-600/20 rounded-full blur-[120px] pointer-events-none"></div>

            <div class="w-full max-w-md relative z-10">
                <div class="text-center lg:text-left mb-10 mt-16 lg:mt-0">
                    <h2 class="text-3xl sm:text-4xl font-black text-white tracking-tight mb-3">Crear cuenta</h2>
                    <p class="text-gray-400 text-base font-light">Completa los datos para acceder a la plataforma.</p>
                </div>

                <!-- Form card -->
                <div class="bg-[#11131a] p-8 sm:p-10 rounded-3xl border border-gray-800/80 shadow-[0_20px_60px_-15px_rgba(0,0,0,0.5)] hover:border-gray-700 transition-colors duration-500">

                    <form method="POST" action="{{ route('register') }}" class="space-y-5">
                        @csrf

                        <!-- Name -->
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-300 mb-2">Nombre completo</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                                    </svg>
                                </div>
                                <input id="name" type="text" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                                    class="w-full pl-12 pr-4 py-3.5 bg-gray-900 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:border-brand-500 focus:ring focus:ring-brand-500/30 focus:outline-none transition-all shadow-inner"
                                    placeholder="Tu nombre completo" />
                            </div>
                            <x-input-error :messages="$errors->get('name')" class="mt-2 text-red-500 text-xs font-medium" />
                        </div>

                        <!-- Email -->
                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-300 mb-2">Correo Electrónico</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                                    </svg>
                                </div>
                                <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                                    class="w-full pl-12 pr-4 py-3.5 bg-gray-900 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:border-brand-500 focus:ring focus:ring-brand-500/30 focus:outline-none transition-all shadow-inner"
                                    placeholder="tunombre@empresa.com" />
                            </div>
                            <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-500 text-xs font-medium" />
                        </div>

                        <!-- Password -->
                        <div>
                            <label for="password" class="block text-sm font-semibold text-gray-300 mb-2">Contraseña</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                                    </svg>
                                </div>
                                <input id="password" type="password" name="password" required autocomplete="new-password"
                                    class="w-full pl-12 pr-4 py-3.5 bg-gray-900 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:border-brand-500 focus:ring focus:ring-brand-500/30 focus:outline-none transition-all shadow-inner"
                                    placeholder="Mínimo 8 caracteres" />
                            </div>
                            <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-500 text-xs font-medium" />
                        </div>

                        <!-- Confirm Password -->
                        <div>
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-300 mb-2">Confirmar Contraseña</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                                    </svg>
                                </div>
                                <input id="password_confirmation" type="password" name="password_confirmation" required autocomplete="new-password"
                                    class="w-full pl-12 pr-4 py-3.5 bg-gray-900 border border-gray-700 rounded-xl text-white placeholder-gray-500 focus:border-brand-500 focus:ring focus:ring-brand-500/30 focus:outline-none transition-all shadow-inner"
                                    placeholder="Repite tu contraseña" />
                            </div>
                            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-red-500 text-xs font-medium" />
                        </div>

                        <!-- Submit -->
                        <div class="pt-4 border-t border-gray-800/80 flex flex-col gap-4">
                            <button type="submit"
                                class="w-full flex justify-center items-center py-4 px-4 text-sm font-extrabold rounded-xl text-white bg-brand-600 hover:bg-brand-500 transition-all shadow-lg shadow-brand-500/25 transform hover:-translate-y-0.5">
                                Crear cuenta
                                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                                </svg>
                            </button>

                            <p class="text-center text-sm text-gray-500 mt-2">
                                ¿Ya tienes cuenta?
                                <a href="{{ route('login') }}" class="font-bold text-white hover:text-brand-400 transition-colors">Iniciar sesión</a>
                            </p>
                        </div>

                    </form>

                </div>
            </div>
        </div>

    </main>

</body>
</html>
