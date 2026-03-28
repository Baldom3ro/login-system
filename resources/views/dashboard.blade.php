@extends('layouts.dashboard')

@section('title', Auth::user()->role === 'admin' ? 'Panel de Administración' : 'Mis Tickets')

@section('content')
<div class="space-y-12 max-w-[1400px] mx-auto">

    @if(Auth::user()->role === 'admin')
        <!-- MÉTRICAS ADMIN SAAS -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
            
            <div class="bg-[#11131a] rounded-3xl border border-gray-800/60 p-7 flex items-end justify-between shadow-xl shadow-black/20 group hover:border-gray-700 hover:-translate-y-1 transition-all duration-300">
                <div class="flex flex-col gap-2">
                    <div class="w-12 h-12 rounded-2xl bg-gray-900 border border-gray-800 flex items-center justify-center text-gray-400 mb-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path></svg>
                    </div>
                    <h3 class="text-4xl font-black text-white group-hover:text-brand-400 transition-colors">{{ $metrics['total'] }}</h3>
                    <p class="text-sm font-semibold text-gray-500 tracking-wide">Tickets Totales</p>
                </div>
            </div>

            <div class="bg-[#11131a] rounded-3xl border border-gray-800/60 p-7 flex items-end justify-between shadow-xl shadow-black/20 group hover:border-emerald-500/30 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-emerald-500/5 rounded-full blur-3xl group-hover:bg-emerald-500/10 transition-colors pointer-events-none"></div>
                <div class="flex flex-col gap-2 relative z-10 w-full">
                    <div class="flex justify-between items-start w-full">
                        <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 border border-emerald-500/20 flex items-center justify-center text-emerald-500 mb-2">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        </div>
                    </div>
                    <h3 class="text-4xl font-black text-white group-hover:text-emerald-400 transition-colors">{{ $metrics['abiertos'] }}</h3>
                    <p class="text-sm font-semibold text-gray-500 tracking-wide">Pendientes (Abiertos)</p>
                </div>
            </div>

            <div class="bg-[#11131a] rounded-3xl border border-gray-800/60 p-7 flex items-end justify-between shadow-xl shadow-black/20 group hover:border-yellow-500/30 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-yellow-500/5 rounded-full blur-3xl group-hover:bg-yellow-500/10 transition-colors pointer-events-none"></div>
                <div class="flex flex-col gap-2 relative z-10 w-full">
                    <div class="w-12 h-12 rounded-2xl bg-yellow-500/10 border border-yellow-500/20 flex items-center justify-center text-yellow-500 mb-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-4xl font-black text-white group-hover:text-yellow-400 transition-colors">{{ $metrics['en_proceso'] }}</h3>
                    <p class="text-sm font-semibold text-gray-500 tracking-wide">Activos (En Proceso)</p>
                </div>
            </div>

            <div class="bg-[#11131a] rounded-3xl border border-gray-800/60 p-7 flex items-end justify-between shadow-xl shadow-black/20 group hover:border-red-500/30 hover:-translate-y-1 transition-all duration-300 relative overflow-hidden">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-red-500/5 rounded-full blur-3xl group-hover:bg-red-500/10 transition-colors pointer-events-none"></div>
                <div class="flex flex-col gap-2 relative z-10 w-full">
                    <div class="w-12 h-12 rounded-2xl bg-red-500/10 border border-red-500/20 flex items-center justify-center text-red-500 mb-2">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"></path></svg>
                    </div>
                    <h3 class="text-4xl font-black text-white group-hover:text-red-400 transition-colors">{{ $metrics['cerrados'] }}</h3>
                    <p class="text-sm font-semibold text-gray-500 tracking-wide">Resueltos (Cerrados)</p>
                </div>
            </div>
            
        </div>
    @else
        <!-- CLIENT CALL TO ACTION -->
        <div class="bg-gradient-to-r from-brand-600 to-[#1e1b4b] rounded-[2rem] p-10 lg:p-14 shadow-2xl relative overflow-hidden flex flex-col md:flex-row items-center justify-between gap-10 border border-brand-500/30">
            <div class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wNSkiLz48L3N2Zz4=')] opacity-50"></div>
            <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-white/5 rounded-full blur-[100px] mix-blend-screen pointer-events-none"></div>
            
            <div class="relative z-10 text-center md:text-left">
                <h3 class="text-3xl lg:text-4xl font-black text-white mb-3">¿Necesitas asistencia técnica?</h3>
                <p class="text-brand-100 text-base max-w-xl leading-relaxed">Describe tu problema y lo incorporaremos al panel de operaciones.</p>
            </div>
            
            <a href="{{ route('tickets.create') }}" class="relative z-10 shrink-0 px-8 py-4 bg-white text-brand-600 font-extrabold rounded-2xl shadow-[0_10px_40px_rgba(0,0,0,0.3)] hover:shadow-[0_15px_50px_rgba(255,255,255,0.2)] transition-all transform hover:-translate-y-1">
                Nuevo Ticket
            </a>
        </div>
    @endif

    <!-- LISTA DE TICKETS TIPO SAAS (CARDS HORIZONTALES) -->
    <div>
        <div class="flex items-center justify-between mb-8">
            <h3 class="text-xl font-bold text-white tracking-tight">Registro de Tickets</h3>
            <span class="text-xs font-bold text-gray-400 bg-gray-900 border border-gray-800 px-4 py-1.5 rounded-full uppercase tracking-wider">{{ $tickets->count() }} Casos</span>
        </div>

        @if($tickets->isEmpty())
            <div class="bg-[#11131a] border border-gray-800/80 border-dashed rounded-[2rem] p-24 text-center flex flex-col items-center shadow-sm">
                <div class="w-24 h-24 bg-gray-900/50 rounded-full flex items-center justify-center mb-6 text-gray-600 shadow-inner">
                    <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                </div>
                <h3 class="text-2xl font-black text-white mb-3 tracking-tight">Estás al día</h3>
                <p class="text-gray-500 text-lg">No hay tickets activos registrados en tu bandeja.</p>
            </div>
        @else
            <div class="space-y-4">
                @foreach($tickets as $ticket)
                    <a href="{{ route('tickets.show', $ticket) }}" class="block w-full bg-[#11131a] border border-gray-800/60 rounded-3xl p-6 lg:p-7 hover:border-gray-600 hover:bg-[#151821] transition-all duration-300 shadow-xl shadow-black/10 group transform hover:-translate-y-0.5">
                        <div class="flex flex-col lg:flex-row lg:items-center justify-between gap-6">
                            
                            <!-- Izquierda: Info principal -->
                            <div class="flex items-center gap-6">
                                @if(Auth::user()->role === 'admin')
                                    <div class="w-14 h-14 shrink-0 rounded-2xl bg-gray-900 border border-gray-800 text-brand-400 flex items-center justify-center font-bold text-lg shadow-inner">
                                        {{ substr($ticket->user->name, 0, 2) }}
                                    </div>
                                @else
                                    <div class="w-14 h-14 shrink-0 rounded-2xl bg-gray-900 border border-gray-800 text-gray-400 flex items-center justify-center shadow-inner">
                                        <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path></svg>
                                    </div>
                                @endif
                                
                                <div class="flex flex-col gap-1">
                                    <h4 class="text-lg font-bold text-white group-hover:text-brand-400 transition-colors line-clamp-1">
                                        {{ $ticket->title }}
                                    </h4>
                                    <div class="flex flex-wrap items-center gap-3 text-xs sm:text-sm text-gray-500 font-medium mt-1">
                                        <span class="text-gray-400 font-bold">#{{ str_pad($ticket->id, 5, '0', STR_PAD_LEFT) }}</span>
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-700"></span>
                                        @if(Auth::user()->role === 'admin')
                                            <span class="truncate max-w-[150px] sm:max-w-none">{{ $ticket->user->name }}</span>
                                            <span class="w-1.5 h-1.5 rounded-full bg-gray-700"></span>
                                        @endif
                                        <span class="flex items-center gap-1">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            {{ $ticket->updated_at->diffForHumans() }}
                                        </span>
                                    </div>
                                </div>
                            </div>

                            <!-- Derecha: Status & Action -->
                            <div class="flex items-center justify-between lg:justify-end gap-6 w-full lg:w-auto mt-4 lg:mt-0 pt-4 lg:pt-0 border-t lg:border-transparent border-gray-800/80">
                                @php
                                    $statusColors = [
                                        'abierto' => 'bg-emerald-500/10 text-emerald-400 border-emerald-500/20 shadow-emerald-500/10',
                                        'en_proceso' => 'bg-yellow-500/10 text-yellow-500 border-yellow-500/20 shadow-yellow-500/10',
                                        'cerrado' => 'bg-red-500/10 text-red-500 border-red-500/20 shadow-red-500/10',
                                    ];
                                    $dotColors = [
                                        'abierto' => 'bg-emerald-400',
                                        'en_proceso' => 'bg-yellow-500',
                                        'cerrado' => 'bg-red-500',
                                    ];
                                    $color = $statusColors[$ticket->status] ?? 'bg-gray-800 text-gray-400 border-gray-700';
                                    $dot = $dotColors[$ticket->status] ?? 'bg-gray-500';
                                @endphp
                                
                                <div class="inline-flex items-center gap-2.5 px-4 py-2 rounded-xl border shadow-lg {{ $color }}">
                                    <span class="relative flex h-2.5 w-2.5">
                                        @if($ticket->status !== 'cerrado')
                                            <span class="animate-ping absolute inline-flex h-full w-full rounded-full opacity-75 {{ $dot }}"></span>
                                        @endif
                                        <span class="relative inline-flex rounded-full h-2.5 w-2.5 {{ $dot }}"></span>
                                    </span>
                                    <span class="text-xs font-black uppercase tracking-widest">{{ str_replace('_', ' ', $ticket->status) }}</span>
                                </div>

                                <div class="w-12 h-12 rounded-2xl bg-gray-900 border border-gray-800 lg:flex items-center justify-center text-gray-400 group-hover:bg-brand-600 group-hover:text-white group-hover:border-brand-500 transition-all shadow-md group-hover:shadow-brand-500/30 hidden">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                </div>
                            </div>
                            
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>

</div>
@endsection