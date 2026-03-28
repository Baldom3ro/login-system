<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="scroll-smooth">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TICKETPRO — Gestión de Soporte Técnico</title>
    <meta name="description" content="Plataforma profesional para gestión de tickets de soporte. Centraliza, da seguimiento y resuelve incidencias con eficiencia.">
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
    <style>
        html { scroll-behavior: smooth; }
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #1f2937; border-radius: 4px; }
        /* Dot pattern (same as dashboard/login) */
        .dot-pattern {
            background-image: url("data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=");
        }
        /* Feature card hover lift */
        .feature-card { transition: transform .25s ease, border-color .25s ease; }
        .feature-card:hover { transform: translateY(-4px); }
        /* Step connector line */
        .step-line::after {
            content: '';
            position: absolute;
            top: 1.5rem;
            left: calc(50% + 1.75rem);
            width: calc(100% - 3.5rem);
            height: 1px;
            background: linear-gradient(90deg, rgba(99,102,241,.4), transparent);
        }
    </style>
</head>
<body class="font-sans antialiased bg-[#0a0c10] text-gray-300 selection:bg-brand-500 selection:text-white min-h-screen">

{{-- ══════════════════════════════════════════════
     NAVBAR
══════════════════════════════════════════════ --}}
<nav class="fixed top-0 w-full z-50 border-b border-gray-800/50 bg-[#0a0c10]/80 backdrop-blur-md">
    <div class="max-w-7xl mx-auto px-6 sm:px-10 h-20 flex items-center justify-between">

        {{-- Logo --}}
        <a href="/" class="flex items-center gap-3 text-white font-black text-xl tracking-tighter hover:text-gray-300 transition-colors">
            <div class="w-8 h-8 rounded-lg bg-brand-600 border border-brand-500 flex items-center justify-center shadow-lg shadow-brand-500/20">
                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            TICKET<span class="text-brand-500">PRO</span>
        </a>

        {{-- Actions --}}
        <div class="flex items-center gap-3">
            @if (Route::has('login'))
                @auth
                    <a href="{{ url('/dashboard') }}"
                       class="px-5 py-2.5 bg-brand-600 hover:bg-brand-500 text-white text-sm font-extrabold rounded-xl shadow-lg shadow-brand-500/25 transition-all transform hover:-translate-y-0.5">
                        Dashboard
                    </a>
                @else
                    <a href="{{ route('login') }}"
                       class="text-sm font-semibold text-gray-400 hover:text-white transition-colors px-3 py-2">
                        Iniciar sesión
                    </a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                           class="px-5 py-2.5 bg-brand-600 hover:bg-brand-500 text-white text-sm font-extrabold rounded-xl shadow-lg shadow-brand-500/25 transition-all transform hover:-translate-y-0.5">
                            Registrarse
                        </a>
                    @endif
                @endauth
            @endif
        </div>
    </div>
</nav>

{{-- ══════════════════════════════════════════════
     HERO
══════════════════════════════════════════════ --}}
<section class="relative min-h-screen flex items-center justify-center overflow-hidden pt-20">

    {{-- Background effects (identical to login/dashboard treatment) --}}
    <div class="absolute top-0 left-0 w-[600px] h-[600px] bg-brand-600/20 rounded-full blur-[140px] mix-blend-screen pointer-events-none"></div>
    <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-blue-600/10 rounded-full blur-[120px] mix-blend-screen pointer-events-none"></div>
    <div class="absolute inset-0 dot-pattern opacity-30"></div>
    <div class="absolute inset-0 bg-gradient-to-b from-[#0a0c10]/0 via-[#0a0c10]/0 to-[#0a0c10]"></div>

    <div class="relative z-10 max-w-5xl mx-auto px-6 sm:px-10 text-center py-24">

        {{-- Badge --}}
        <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-gray-950 border border-gray-800 text-brand-400 font-bold text-xs mb-8 shadow-sm">
            <span class="w-1.5 h-1.5 rounded-full bg-brand-500 animate-pulse"></span>
            Sistema Profesional · Soporte en Tiempo Real
        </div>

        {{-- Heading --}}
        <h1 class="text-5xl sm:text-6xl lg:text-7xl font-black text-white tracking-tight leading-none mb-6">
            Resuelve Incidencias<br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-400 to-blue-500">Sin Complicaciones.</span>
        </h1>

        {{-- Sub --}}
        <p class="text-lg md:text-xl text-gray-400 leading-relaxed max-w-2xl mx-auto mb-10 font-light">
            Centraliza, organiza y da seguimiento a cada solicitud con una plataforma de soporte técnico moderna, intuitiva y potente.
        </p>

        {{-- CTAs --}}
        <div class="flex flex-col sm:flex-row items-center justify-center gap-4 mb-20">
            <a href="{{ route('login') }}"
               class="w-full sm:w-auto flex justify-center items-center gap-2 py-4 px-8 text-sm font-extrabold rounded-xl text-white bg-brand-600 hover:bg-brand-500 transition-all shadow-lg shadow-brand-500/25 transform hover:-translate-y-0.5">
                Iniciar sesión
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
            <a href="{{ route('register') }}"
               class="w-full sm:w-auto flex justify-center items-center gap-2 py-4 px-8 text-sm font-extrabold rounded-xl text-gray-300 bg-[#11131a] border border-gray-800 hover:border-gray-700 hover:text-white transition-all transform hover:-translate-y-0.5">
                Crear cuenta gratis
            </a>
        </div>

        {{-- Dashboard mockup --}}
        <div class="bg-[#0f111a] border border-gray-800/70 rounded-3xl shadow-[0_40px_100px_-20px_rgba(0,0,0,0.7)] overflow-hidden max-w-4xl mx-auto">
            {{-- Browser bar --}}
            <div class="flex items-center gap-2 px-5 py-4 border-b border-gray-800/60 bg-[#0c0d14]">
                <div class="w-2.5 h-2.5 rounded-full bg-red-500/50"></div>
                <div class="w-2.5 h-2.5 rounded-full bg-yellow-500/50"></div>
                <div class="w-2.5 h-2.5 rounded-full bg-green-500/50"></div>
                <div class="ml-3 flex-1 h-5 max-w-[180px] bg-gray-800 rounded-md"></div>
                <span class="ml-auto text-xs font-mono text-gray-700">ticketpro</span>
            </div>
            {{-- Mockup content --}}
            <div class="p-6 lg:p-8">
                {{-- Top row --}}
                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center gap-3">
                        <div class="w-8 h-8 rounded-lg bg-brand-600/20 border border-brand-500/20"></div>
                        <div class="space-y-2">
                            <div class="h-2.5 w-32 bg-gray-800 rounded-full"></div>
                            <div class="h-2 w-20 bg-gray-900 rounded-full"></div>
                        </div>
                    </div>
                    <div class="h-8 w-28 rounded-xl bg-brand-600/20 border border-brand-500/20"></div>
                </div>
                {{-- Metric cards --}}
                <div class="grid grid-cols-3 gap-4 mb-6">
                    <div class="bg-[#11131a] border border-gray-800/60 rounded-2xl p-4">
                        <div class="w-8 h-8 rounded-xl bg-gray-900 border border-gray-800 mb-3"></div>
                        <div class="h-6 w-10 bg-gray-700 rounded-lg mb-1.5"></div>
                        <div class="h-2 w-20 bg-gray-800 rounded-full"></div>
                    </div>
                    <div class="bg-[#11131a] border border-emerald-500/15 rounded-2xl p-4">
                        <div class="w-8 h-8 rounded-xl bg-emerald-500/10 border border-emerald-500/20 mb-3"></div>
                        <div class="h-6 w-10 bg-emerald-500/30 rounded-lg mb-1.5"></div>
                        <div class="h-2 w-24 bg-gray-800 rounded-full"></div>
                    </div>
                    <div class="bg-[#11131a] border border-yellow-500/15 rounded-2xl p-4">
                        <div class="w-8 h-8 rounded-xl bg-yellow-500/10 border border-yellow-500/20 mb-3"></div>
                        <div class="h-6 w-10 bg-yellow-500/30 rounded-lg mb-1.5"></div>
                        <div class="h-2 w-16 bg-gray-800 rounded-full"></div>
                    </div>
                </div>
                {{-- Ticket rows --}}
                <div class="space-y-3">
                    @foreach([
                        ['emerald', 'w-48', 'w-20'],
                        ['yellow',  'w-36', 'w-24'],
                        ['brand',   'w-52', 'w-16'],
                    ] as [$color, $tw, $sw])
                    <div class="flex items-center gap-4 bg-[#11131a] border border-gray-800/60 rounded-2xl p-4">
                        <div class="w-10 h-10 rounded-xl bg-gray-900 border border-gray-800 flex-shrink-0"></div>
                        <div class="flex-1 space-y-2">
                            <div class="h-2.5 {{ $tw }} bg-gray-700 rounded-full"></div>
                            <div class="h-2 w-32 bg-gray-800 rounded-full"></div>
                        </div>
                        <div class="h-6 {{ $sw }} rounded-xl bg-{{ $color }}-500/15 border border-{{ $color }}-500/20 flex-shrink-0"></div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</section>

{{-- ══════════════════════════════════════════════
     FEATURES
══════════════════════════════════════════════ --}}
<section class="py-28 px-6 sm:px-10 relative">
    <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-brand-600/5 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="max-w-6xl mx-auto relative z-10">

        {{-- Header --}}
        <div class="text-center mb-20">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-gray-950 border border-gray-800 text-brand-400 font-bold text-xs mb-6 shadow-sm">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3l14 9-14 9V3z"/>
                </svg>
                Características
            </div>
            <h2 class="text-4xl md:text-5xl font-black text-white tracking-tight mb-4">
                Todo lo que necesitas,<br class="hidden sm:block"> en un solo lugar.
            </h2>
            <p class="text-gray-500 text-lg max-w-xl mx-auto font-light">
                Herramientas diseñadas para que tu equipo de soporte trabaje de forma más eficiente y sin fricciones.
            </p>
        </div>

        {{-- Grid --}}
        <div class="grid md:grid-cols-3 gap-6">

            {{-- Card: Seguridad --}}
            <div class="feature-card bg-[#11131a] border border-gray-800/60 rounded-3xl p-8 hover:border-gray-700 shadow-xl shadow-black/20 relative overflow-hidden group">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-brand-600/5 rounded-full blur-3xl group-hover:bg-brand-600/10 transition-colors pointer-events-none"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 rounded-2xl bg-gray-900 border border-gray-800 flex items-center justify-center text-gray-400 group-hover:text-brand-400 group-hover:border-brand-500/30 transition-all mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-black text-white mb-3 tracking-tight">Seguridad Robusta</h3>
                    <p class="text-gray-500 leading-relaxed text-sm font-light">
                        Autenticación multicapa, sesiones protegidas y roles de acceso diferenciados. Tu información está siempre resguardada.
                    </p>
                </div>
            </div>

            {{-- Card: Roles (highlighted) --}}
            <div class="feature-card bg-gradient-to-b from-brand-600 to-[#1e1b4b] border border-brand-500/30 rounded-3xl p-8 shadow-xl shadow-brand-500/10 relative overflow-hidden group">
                <div class="absolute inset-0 dot-pattern opacity-20"></div>
                <div class="absolute top-0 right-0 w-[200px] h-[200px] bg-white/5 rounded-full blur-[60px] pointer-events-none"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 rounded-2xl bg-white/10 border border-white/20 flex items-center justify-center text-white mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-black text-white mb-3 tracking-tight">Roles y Permisos</h3>
                    <p class="text-brand-100 leading-relaxed text-sm font-light">
                        Administrador con visión total del sistema. Cliente con acceso a sus propias solicitudes. Control granular de accesos.
                    </p>
                </div>
            </div>

            {{-- Card: Gestión --}}
            <div class="feature-card bg-[#11131a] border border-gray-800/60 rounded-3xl p-8 hover:border-gray-700 shadow-xl shadow-black/20 relative overflow-hidden group">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-blue-600/5 rounded-full blur-3xl group-hover:bg-blue-600/8 transition-colors pointer-events-none"></div>
                <div class="relative z-10">
                    <div class="w-12 h-12 rounded-2xl bg-gray-900 border border-gray-800 flex items-center justify-center text-gray-400 group-hover:text-brand-400 group-hover:border-brand-500/30 transition-all mb-6">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-black text-white mb-3 tracking-tight">Gestión en Tiempo Real</h3>
                    <p class="text-gray-500 leading-relaxed text-sm font-light">
                        Canal de mensajes directo entre cliente y soporte. Estado del ticket visible y actualizado al instante desde cualquier dispositivo.
                    </p>
                </div>
            </div>

        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════
     HOW IT WORKS
══════════════════════════════════════════════ --}}
<section class="py-28 px-6 sm:px-10 relative border-t border-gray-800/40">
    <div class="absolute bottom-0 left-0 w-[400px] h-[400px] bg-blue-600/5 rounded-full blur-[100px] pointer-events-none"></div>

    <div class="max-w-5xl mx-auto relative z-10">

        {{-- Header --}}
        <div class="text-center mb-20">
            <div class="inline-flex items-center gap-2 px-3 py-1.5 rounded-full bg-gray-950 border border-gray-800 text-brand-400 font-bold text-xs mb-6 shadow-sm">
                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                </svg>
                Flujo del Sistema
            </div>
            <h2 class="text-4xl md:text-5xl font-black text-white tracking-tight mb-4">
                Cómo funciona.
            </h2>
            <p class="text-gray-500 text-lg max-w-lg mx-auto font-light">
                Tres pasos simples para convertir un problema en una solución documentada y trazable.
            </p>
        </div>

        {{-- Steps --}}
        <div class="grid lg:grid-cols-3 gap-6 relative">

            {{-- Connector lines (desktop) --}}
            <div class="hidden lg:block absolute top-6 left-[calc(33.33%+1rem)] right-[calc(33.33%+1rem)] h-px bg-gradient-to-r from-brand-600/40 to-brand-600/20"></div>

            {{-- Step 1 --}}
            <div class="relative">
                <div class="flex items-start gap-4 mb-6">
                    <div class="w-12 h-12 shrink-0 rounded-full bg-brand-600 border border-brand-500 flex items-center justify-center font-black text-white text-sm shadow-lg shadow-brand-500/30 z-10 relative">01</div>
                    <div class="pt-3 h-px flex-1 bg-gradient-to-r from-brand-600/40 to-transparent lg:hidden"></div>
                </div>
                <div class="bg-[#11131a] border border-gray-800/60 rounded-3xl p-7 hover:border-gray-700 transition-all shadow-xl shadow-black/20">
                    <div class="w-10 h-10 rounded-xl bg-gray-900 border border-gray-800 flex items-center justify-center text-gray-400 mb-5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-black text-white mb-2 tracking-tight">Crear Ticket</h3>
                    <p class="text-gray-500 text-sm leading-relaxed font-light">
                        Describe tu problema con título, categoría y detalle. El sistema lo registra y notifica al equipo de soporte automáticamente.
                    </p>
                </div>
            </div>

            {{-- Step 2 --}}
            <div class="relative">
                <div class="flex items-start gap-4 mb-6">
                    <div class="w-12 h-12 shrink-0 rounded-full bg-brand-600 border border-brand-500 flex items-center justify-center font-black text-white text-sm shadow-lg shadow-brand-500/30 z-10 relative">02</div>
                    <div class="pt-3 h-px flex-1 bg-gradient-to-r from-brand-600/40 to-transparent lg:hidden"></div>
                </div>
                <div class="bg-[#11131a] border border-brand-500/20 rounded-3xl p-7 hover:border-brand-500/40 transition-all shadow-xl shadow-black/20 relative overflow-hidden">
                    <div class="absolute -right-8 -top-8 w-32 h-32 bg-brand-600/8 rounded-full blur-2xl pointer-events-none"></div>
                    <div class="w-10 h-10 rounded-xl bg-brand-600/10 border border-brand-500/20 flex items-center justify-center text-brand-400 mb-5 relative z-10">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-black text-white mb-2 tracking-tight relative z-10">Seguimiento</h3>
                    <p class="text-gray-500 text-sm leading-relaxed font-light relative z-10">
                        Recibe respuestas del equipo directamente en el ticket. Visualiza el estado y el historial completo de conversaciones.
                    </p>
                </div>
            </div>

            {{-- Step 3 --}}
            <div class="relative">
                <div class="flex items-start gap-4 mb-6">
                    <div class="w-12 h-12 shrink-0 rounded-full bg-brand-600 border border-brand-500 flex items-center justify-center font-black text-white text-sm shadow-lg shadow-brand-500/30 z-10 relative">03</div>
                </div>
                <div class="bg-[#11131a] border border-gray-800/60 rounded-3xl p-7 hover:border-gray-700 transition-all shadow-xl shadow-black/20">
                    <div class="w-10 h-10 rounded-xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-500 mb-5">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                    </div>
                    <h3 class="text-lg font-black text-white mb-2 tracking-tight">Resolución</h3>
                    <p class="text-gray-500 text-sm leading-relaxed font-light">
                        El ticket se cierra con la solución documentada. Historial disponible para consultas y auditorías futuras.
                    </p>
                </div>
            </div>

        </div>

        {{-- CTA --}}
        <div class="text-center mt-16">
            <a href="{{ route('register') }}"
               class="inline-flex items-center justify-center gap-2 py-4 px-10 text-sm font-extrabold rounded-xl text-white bg-brand-600 hover:bg-brand-500 transition-all shadow-lg shadow-brand-500/25 transform hover:-translate-y-0.5">
                Empezar ahora — es gratis
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
                </svg>
            </a>
        </div>

    </div>
</section>

{{-- ══════════════════════════════════════════════
     FOOTER
══════════════════════════════════════════════ --}}
<footer class="border-t border-gray-800/50 bg-[#0f111a] py-12 px-6 sm:px-10">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row items-center justify-between gap-6">

        {{-- Brand --}}
        <a href="/" class="flex items-center gap-2.5 text-white font-black text-base tracking-tighter hover:text-gray-300 transition-colors">
            <div class="w-7 h-7 rounded-lg bg-brand-600 border border-brand-500 flex items-center justify-center shadow-md shadow-brand-500/20">
                <svg class="w-4 h-4 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                </svg>
            </div>
            TICKET<span class="text-brand-500">PRO</span>
        </a>

        {{-- Links --}}
        <div class="flex items-center gap-8 text-sm text-gray-600">
            <a href="#" class="hover:text-brand-400 transition-colors font-medium">Términos de uso</a>
            <a href="#" class="hover:text-brand-400 transition-colors font-medium">Privacidad</a>
            <a href="#" class="hover:text-brand-400 transition-colors font-medium">Soporte</a>
        </div>

        {{-- Copyright --}}
        <p class="text-gray-700 text-sm font-medium">
            © {{ date('Y') }} TicketPro. Todos los derechos reservados.
        </p>

    </div>
</footer>

</body>
</html>
