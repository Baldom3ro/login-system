<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'TicketPro') }}</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    
    <!-- Fallback CDN para asegurar el diseño si Vite no compila localmente -->
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
<body class="font-sans antialiased bg-gray-950 text-gray-300 selection:bg-brand-500 selection:text-white overflow-x-hidden">

    <!-- Top Navigation sin Navbar obsoleto -->
    <nav class="absolute w-full z-50 top-0 left-0 px-6 py-8 sm:px-12 lg:px-24 flex justify-between items-center bg-transparent">
        <div class="flex items-center gap-2 text-white font-black text-2xl tracking-tighter">
            <svg class="w-8 h-8 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
            TICKET<span class="text-brand-500">PRO</span>
        </div>
        
        <div class="flex items-center gap-6">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}" class="text-sm font-semibold text-gray-300 hover:text-white transition-colors">Panel de Control</a>
                @else
                    <a href="{{ route('login') }}" class="hidden sm:block text-sm font-semibold text-gray-300 hover:text-white transition-colors">Entrar</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="text-sm font-bold bg-brand-600 text-white px-6 py-2.5 rounded-xl hover:bg-brand-500 transition-all shadow-lg border border-brand-500/50 shadow-brand-500/20">Registro</a>
                    @endif
                @endauth
            @endif
        </div>
    </nav>

    <!-- 1. HERO SECTION -->
    <main class="relative min-h-screen flex items-center justify-center pt-24 pb-20">
        <!-- Fondos con gradientes suaves -->
        <div class="absolute inset-0 bg-[radial-gradient(ellipse_at_top,_var(--tw-gradient-stops))] from-gray-900 via-gray-950 to-gray-950 pointer-events-none"></div>
        <div class="absolute top-1/4 left-1/4 w-[600px] h-[600px] bg-brand-600/10 rounded-full blur-[120px] pointer-events-none mix-blend-screen"></div>
        <div class="absolute bottom-1/4 right-1/4 w-[400px] h-[400px] bg-blue-600/10 rounded-full blur-[100px] pointer-events-none mix-blend-screen"></div>

        <div class="relative z-10 w-full max-w-7xl mx-auto px-6 sm:px-12 lg:px-24 grid grid-cols-1 lg:grid-cols-2 gap-16 lg:gap-8 items-center">
            
            <!-- Contenido Texto -->
            <div class="text-center lg:text-left flex flex-col justify-center">
                <div class="inline-flex items-center gap-2 px-4 py-1.5 rounded-full bg-gray-900 border border-gray-800 text-gray-400 font-medium text-xs sm:text-sm mb-8 w-fit mx-auto lg:mx-0 shadow-sm">
                    <span class="relative flex h-2 w-2">
                        <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-brand-400 opacity-75"></span>
                        <span class="relative inline-flex rounded-full h-2 w-2 bg-brand-500"></span>
                    </span>
                    Sistema Activo y Desplegado
                </div>
                
                <h1 class="text-5xl sm:text-6xl lg:text-7xl font-black text-white tracking-tight leading-[1.1] mb-6">
                    Soporte técnico <br/>
                    <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-400 to-blue-500">
                        sin fronteras.
                    </span>
                </h1>
                
                <p class="text-lg sm:text-xl text-gray-400 mb-12 leading-relaxed max-w-2xl mx-auto lg:mx-0 font-light">
                    Transforma la manera en que resuelves los incidentes. Centraliza tus solicitudes en un entorno oscuro, rápido e intuitivo diseñado para la máxima productividad.
                </p>
                
                <div class="flex flex-col sm:flex-row items-center gap-4 justify-center lg:justify-start">
                    @if (Route::has('login'))
                        @auth
                            <a href="{{ url('/dashboard') }}" class="w-full sm:w-auto px-8 py-4 text-base font-bold text-white bg-brand-600 border border-transparent rounded-xl hover:bg-brand-500 shadow-lg shadow-brand-500/25 transition-all transform hover:-translate-y-1 text-center">
                                Ir al Dashboard
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="w-full sm:w-auto px-8 py-4 text-base font-bold text-white bg-brand-600 border border-transparent rounded-xl hover:bg-brand-500 shadow-lg shadow-brand-500/25 transition-all transform hover:-translate-y-1 text-center">
                                Iniciar Sesión
                            </a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="w-full sm:w-auto px-8 py-4 text-base font-bold text-white bg-transparent border-2 border-gray-800 rounded-xl hover:border-gray-600 hover:bg-gray-900 transition-all text-center">
                                    Registrarse
                                </a>
                            @endif
                        @endauth
                    @endif
                </div>
            </div>

            <!-- Visual Mockup (Card Destacada simulando el sistema) -->
            <div class="w-full max-w-[500px] mx-auto lg:ml-auto relative perspective-1000 mt-10 lg:mt-0">
                <div class="relative bg-[#0f111a] border border-gray-800 shadow-2xl rounded-2xl p-6 transform lg:-rotate-2 hover:rotate-0 transition-transform duration-700 ease-out z-20">
                    <!-- Decoración top-bar Mac -->
                    <div class="flex gap-2 items-center border-b border-gray-800 pb-4 mb-6">
                        <div class="w-3 h-3 rounded-full bg-gray-700"></div>
                        <div class="w-3 h-3 rounded-full bg-gray-700"></div>
                        <div class="w-3 h-3 rounded-full bg-gray-700"></div>
                        <div class="ml-3 text-xs text-gray-500 font-medium tracking-wide">Ticket #2059 - Caída de BD</div>
                    </div>
                    
                    <!-- Chat UI Simulado -->
                    <div class="space-y-6">
                        <div class="flex gap-3">
                            <div class="w-8 h-8 rounded-full bg-gray-800 flex items-center justify-center text-xs font-bold text-gray-400 shrink-0 shadow-inner">U</div>
                            <div class="bg-gray-800 p-4 rounded-2xl rounded-tl-none w-5/6 border border-gray-700/50 shadow-sm">
                                <p class="text-sm text-gray-300 leading-relaxed">El entorno de producción está caído, arrojando error de conexión 500 constante.</p>
                            </div>
                        </div>
                        <div class="flex gap-3 flex-row-reverse">
                            <div class="w-8 h-8 rounded-full bg-brand-600 flex items-center justify-center text-xs font-bold text-white shrink-0 shadow-inner">A</div>
                            <div class="bg-brand-600/10 border border-brand-500/20 p-4 rounded-2xl rounded-tr-none w-5/6 text-left shadow-sm">
                                <p class="text-sm text-indigo-100 leading-relaxed">Recibido. Hemos restaurado el servicio y limpiado el caché. Por favor, verifica tu acceso.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Botón de estado flotante -->
                    <div class="absolute -right-6 -bottom-6 bg-gray-900 border border-emerald-500/30 px-5 py-3 rounded-xl flex items-center gap-3 shadow-2xl">
                        <div class="w-2.5 h-2.5 bg-emerald-500 rounded-full shadow-[0_0_10px_rgba(16,185,129,0.8)] animate-pulse"></div>
                        <span class="text-[11px] font-black text-white uppercase tracking-widest">Resuelto</span>
                    </div>
                </div>

                <!-- Glow background for the mockup -->
                <div class="absolute inset-0 bg-brand-500/20 blur-3xl -z-10 transform scale-95 translate-y-4"></div>
            </div>
        </div>
    </main>

    <!-- 2. SECCIÓN DE CARACTERÍSTICAS (Grid estructurado) -->
    <section class="py-32 bg-gray-950 relative z-10">
        <div class="max-w-7xl mx-auto px-6 sm:px-12 lg:px-24">
            
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Card 1 -->
                <div class="bg-[#11131a] p-10 rounded-3xl border border-gray-800/80 shadow-xl hover:border-gray-700 transition-colors duration-300 group">
                    <div class="w-14 h-14 bg-gray-900/80 border border-gray-800 rounded-2xl flex items-center justify-center mb-8 text-brand-400 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-4">Creación Sencilla</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Abre tickets de soporte con la información crítica. Cero fricción, formularios breves y la atención donde más se necesita de forma instantánea y eficaz.
                    </p>
                </div>

                <!-- Card 2 -->
                <div class="bg-[#11131a] p-10 rounded-3xl border border-gray-800/80 shadow-xl hover:border-gray-700 transition-colors duration-300 group">
                    <div class="w-14 h-14 bg-gray-900/80 border border-gray-800 rounded-2xl flex items-center justify-center mb-8 text-blue-400 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-4">Seguimiento Rápido</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Un vistazo basta para conocer la realidad del caso. Etiquetas que definen estados claramente distinguibles para administrar la demanda rápidamente.
                    </p>
                </div>

                <!-- Card 3 -->
                <div class="bg-[#11131a] p-10 rounded-3xl border border-gray-800/80 shadow-xl hover:border-gray-700 transition-colors duration-300 group">
                    <div class="w-14 h-14 bg-gray-900/80 border border-gray-800 rounded-2xl flex items-center justify-center mb-8 text-purple-400 group-hover:scale-110 transition-transform">
                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold text-white mb-4">Chat Integrado</h3>
                    <p class="text-gray-400 text-sm leading-relaxed">
                        Soluciona consultas conversando tal como lo harías en cualquier red social. Mantiene el historial íntegro ordenado cronológicamente para evitar desinformación.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- 3. SECCIÓN ADICIONAL IMPORTANT: Cómo Funciona / Flujo -->
    <section class="py-32 bg-gray-900 relative z-10">
        <div class="max-w-7xl mx-auto px-6 sm:px-12 lg:px-24">
            <div class="text-center mb-20">
                <h2 class="text-4xl md:text-5xl font-black text-white tracking-tight mb-5">El flujo del soporte</h2>
                <p class="text-gray-400 text-lg max-w-2xl mx-auto font-light">Comienza un caso en milisegundos. Resolvemos el resto.</p>
            </div>

            <div class="relative mt-24">
                <!-- Linea Horizontal Conectora -->
                <div class="hidden md:block absolute top-[3rem] left-[15%] right-[15%] h-[2px] bg-gray-800 -z-10"></div>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-16 text-center">
                    <!-- Paso 1 -->
                    <div class="flex flex-col items-center">
                        <div class="w-24 h-24 bg-gray-900 border-4 border-gray-950 rounded-full flex items-center justify-center mb-8 relative shadow-2xl">
                            <span class="text-3xl font-black text-white outline-text">1</span>
                        </div>
                        <h4 class="text-xl font-bold text-white mb-3">Crear Inidencia</h4>
                        <p class="text-sm text-gray-400 w-4/5 mx-auto leading-relaxed">Indica detalles precisos y remite tu inquietud a la base en tan solo unos segundos.</p>
                    </div>

                    <!-- Paso 2 -->
                    <div class="flex flex-col items-center">
                        <div class="w-24 h-24 bg-gray-900 border-4 border-gray-950 rounded-full flex items-center justify-center mb-8 relative shadow-2xl">
                            <span class="text-3xl font-black text-white outline-text">2</span>
                        </div>
                        <h4 class="text-xl font-bold text-white mb-3">Auditoría</h4>
                        <p class="text-sm text-gray-400 w-4/5 mx-auto leading-relaxed">Chatea sin interrupciones con el ingeniero asignado informando la evolución de tu fallo.</p>
                    </div>

                    <!-- Paso 3 -->
                    <div class="flex flex-col items-center">
                        <div class="w-24 h-24 bg-brand-600 border-4 border-gray-950 rounded-full flex items-center justify-center mb-8 relative shadow-xl shadow-brand-500/20">
                            <span class="text-3xl font-black text-white">3</span>
                        </div>
                        <h4 class="text-xl font-bold text-white mb-3">Resolución</h4>
                        <p class="text-sm text-gray-400 w-4/5 mx-auto leading-relaxed">Tras solucionar el evento, el administrador marcará el ticket como completado y archivado.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- 4. FOOTER: Simple y no pegado -->
    <footer class="pt-16 pb-12 bg-gray-950 mt-10">
        <div class="max-w-7xl mx-auto px-6 sm:px-12 lg:px-24 flex flex-col md:flex-row justify-between items-center gap-6 text-center md:text-left border-t border-gray-900 pt-10">
            <div class="flex items-center justify-center md:justify-start gap-2 text-white font-bold text-lg">
                <svg class="w-5 h-5 text-brand-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                Ticket<span class="text-brand-500">Pro</span>
            </div>
            
            <p class="text-xs text-gray-600 font-medium">
                &copy; {{ date('Y') }} Red Corporativa. Todos los derechos reservados.
            </p>
        </div>
    </footer>

</body>
</html>
