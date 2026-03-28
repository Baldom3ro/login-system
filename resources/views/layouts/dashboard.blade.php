<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'TicketPro') }} - @yield('title', 'Dashboard')</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=inter:400,500,600,700,800,900&display=swap" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: { sans: ['Inter', 'sans-serif'] },
                    colors: { brand: { 400: '#818cf8', 500: '#6366f1', 600: '#4f46e5' } }
                }
            }
        }
    </script>
    <style>
        .custom-scrollbar::-webkit-scrollbar { width: 6px; }
        .custom-scrollbar::-webkit-scrollbar-track { background: transparent; }
        .custom-scrollbar::-webkit-scrollbar-thumb { background: #1f2937; border-radius: 4px; }
        .custom-scrollbar::-webkit-scrollbar-thumb:hover { background: #374151; }
    </style>
</head>
<body class="font-sans antialiased bg-[#0a0c10] text-gray-300 flex h-screen overflow-hidden selection:bg-brand-500 selection:text-white">
    
    <!-- Sidebar -->
    <aside class="w-[280px] bg-[#0f111a] border-r border-gray-800/60 flex flex-col h-full shrink-0 relative z-20">
        <div class="h-20 flex items-center px-8 border-b border-gray-800/50">
            <a href="/" class="flex items-center gap-3 text-white font-black text-xl tracking-tighter">
                <div class="w-8 h-8 rounded-lg bg-brand-600 border border-brand-500 flex items-center justify-center shadow-lg shadow-brand-500/20">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                </div>
                TICKET<span class="text-brand-500">PRO</span>
            </a>
        </div>
        
        <nav class="flex-1 overflow-y-auto py-8 px-5 space-y-2 relative custom-scrollbar">
            <div class="text-xs font-bold text-gray-600 uppercase tracking-wider mb-4 px-3">Navegación</div>
            
            <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('dashboard') ? 'bg-brand-600/10 text-brand-400 font-bold border border-brand-500/10' : 'text-gray-400 hover:bg-gray-800/50 hover:text-white transition-colors' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2V6zM14 6a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2V6zM4 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2H6a2 2 0 01-2-2v-2zM14 16a2 2 0 012-2h2a2 2 0 012 2v2a2 2 0 01-2 2h-2a2 2 0 01-2-2v-2z"></path></svg>
                Dashboard
            </a>
            
            <a href="{{ route('tickets.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('tickets.index') ? 'bg-brand-600/10 text-brand-400 font-bold border border-brand-500/10' : 'text-gray-400 hover:bg-gray-800/50 hover:text-white transition-colors' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                Todos los Tickets
            </a>
            
            <div class="pt-6 pb-2">
                <div class="text-xs font-bold text-gray-600 uppercase tracking-wider mb-4 px-3">Soporte</div>
            </div>

            <a href="{{ route('tickets.create') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('tickets.create') ? 'bg-brand-600/10 text-brand-400 font-bold border border-brand-500/10' : 'text-gray-400 hover:bg-gray-800/50 hover:text-white transition-colors' }}">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Nuevo Ticket
            </a>
        </nav>

        <div class="p-6 border-t border-gray-800/50 bg-[#0c0d14]">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="w-full flex justify-between items-center px-4 py-3 text-gray-400 hover:bg-red-500/10 hover:text-red-400 hover:border-red-500/20 border border-transparent rounded-xl transition-all font-medium text-sm group">
                    <div class="flex items-center gap-3">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                        Desconectar
                    </div>
                </button>
            </form>
        </div>
    </aside>

    <!-- Main Content -->
    <main class="flex-1 flex flex-col h-full bg-[#0a0c10] overflow-hidden relative">
        <!-- Decoration glow -->
        <div class="absolute top-0 right-0 w-[600px] h-[600px] bg-brand-600/5 rounded-full blur-[120px] pointer-events-none mix-blend-screen"></div>
        <div class="absolute bottom-0 left-1/4 w-[400px] h-[400px] bg-blue-600/5 rounded-full blur-[100px] pointer-events-none mix-blend-screen"></div>
        
        <!-- Header interno -->
        <header class="h-20 flex justify-between items-center px-8 lg:px-12 border-b border-gray-800/50 bg-[#0a0c10]/80 backdrop-blur-md z-10 shrink-0">
            <h1 class="text-2xl font-black text-white tracking-tight">@yield('title', 'Panel')</h1>
            
            <div class="flex items-center gap-5">
                <div class="w-10 h-10 rounded-full bg-gray-900 border border-gray-800 flex items-center justify-center text-gray-400 hover:text-white hover:bg-gray-800 cursor-pointer transition-colors relative">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9"></path></svg>
                    <span class="absolute top-0 right-0 w-2.5 h-2.5 bg-red-500 rounded-full border-2 border-[#0a0c10]"></span>
                </div>

                <div class="h-8 w-px bg-gray-800"></div>

                <div class="flex items-center gap-3 cursor-pointer group">
                    <div class="flex flex-col items-end">
                        <span class="text-sm font-bold text-white group-hover:text-brand-400 transition-colors">{{ Auth::user()->name }}</span>
                        <span class="text-[11px] font-black {{ Auth::user()->role === 'admin' ? 'text-brand-500' : 'text-gray-500' }} uppercase tracking-wider">{{ Auth::user()->role }}</span>
                    </div>
                    <div class="w-10 h-10 rounded-xl bg-[#11131a] border border-gray-700 flex items-center justify-center text-white font-bold text-sm shadow-inner group-hover:border-brand-500/50 transition-colors">
                        {{ substr(Auth::user()->name, 0, 2) }}
                    </div>
                </div>
            </div>
        </header>

        <!-- Scrollable content -->
        <div class="flex-1 overflow-y-auto p-8 lg:p-12 z-10 custom-scrollbar relative">
            @yield('content')
        </div>
    </main>

</body>
</html>
