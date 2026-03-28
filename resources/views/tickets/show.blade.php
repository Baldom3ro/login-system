@extends('layouts.dashboard')

@section('title', 'Ticket #' . str_pad($ticket->id, 5, '0', STR_PAD_LEFT))

@section('content')
<div class="max-w-[1400px] mx-auto">
    
    <div class="flex flex-col lg:flex-row gap-8">
        
        <!-- Hilo de Conversación (Chat UI) -->
        <div class="flex-1 flex flex-col min-h-[600px] bg-[#11131a] border border-gray-800/60 rounded-[2.5rem] overflow-hidden shadow-2xl relative">
            
            <!-- Header del Chat -->
            <div class="px-8 py-6 border-b border-gray-800/50 bg-gray-900/30 flex items-center justify-between backdrop-blur-sm sticky top-0 z-10">
                <div class="flex items-center gap-4">
                    <a href="{{ route('tickets.index') }}" class="w-10 h-10 rounded-xl bg-gray-800 border border-gray-700 flex items-center justify-center text-gray-400 hover:text-white hover:bg-gray-700 transition-all">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    </a>
                    <div>
                        <h4 class="text-white font-bold leading-tight">{{ $ticket->title }}</h4>
                        <p class="text-xs text-gray-500 font-medium">Iniciado {{ $ticket->created_at->diffForHumans() }}</p>
                    </div>
                </div>
                
                <div class="flex items-center gap-2">
                    @php
                        $statusColors = [
                            'abierto' => 'text-emerald-400 bg-emerald-500/10 border-emerald-500/20',
                            'en_proceso' => 'text-yellow-500 bg-yellow-500/10 border-yellow-500/20',
                            'cerrado' => 'text-gray-400 bg-gray-500/10 border-gray-800',
                        ];
                        $colorClass = $statusColors[$ticket->status] ?? 'text-gray-400 bg-gray-800';
                    @endphp
                    <span class="px-3 py-1 rounded-full border text-[10px] font-black uppercase tracking-widest {{ $colorClass }}">
                        {{ str_replace('_', ' ', $ticket->status) }}
                    </span>
                </div>
            </div>

            <!-- Area de Mensajes -->
            <div class="flex-1 overflow-y-auto p-8 space-y-8 custom-scrollbar bg-[url('data:image/svg+xml;base64,PHN2ZyB3aWR0aD0iMjAiIGhlaWdodD0iMjAiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9InJnYmEoMjU1LDI1NSwyNTUsMC4wMikiLz48L3N2Zz4=')]">
                
                <!-- Ticket Original -->
                <div class="flex flex-col gap-2 {{ Auth::id() === $ticket->user_id ? 'items-end' : 'items-start' }}">
                    <div class="flex items-center gap-2 px-2">
                        <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">{{ $ticket->user->name }}</span>
                        <span class="text-[10px] text-gray-600">{{ $ticket->created_at->format('H:i') }}</span>
                    </div>
                    <div class="max-w-[85%] p-6 rounded-[2rem] shadow-xl {{ Auth::id() === $ticket->user_id ? 'bg-brand-600 text-white rounded-tr-none' : 'bg-gray-900 border border-gray-800 text-gray-300 rounded-tl-none' }}">
                        <p class="text-sm leading-relaxed whitespace-pre-wrap">{{ $ticket->description }}</p>
                    </div>
                </div>

                <!-- Historial -->
                @foreach($ticket->messages as $msg)
                    @php
                        $isMe = Auth::id() === $msg->user_id;
                        $isAdmin = $msg->user->role === 'admin';
                    @endphp
                    <div class="flex flex-col gap-2 {{ $isMe ? 'items-end' : 'items-start' }}">
                        <div class="flex items-center gap-2 px-2">
                            @if($isAdmin && !$isMe)
                                <span class="px-2 py-0.5 rounded bg-brand-500/10 text-brand-400 text-[9px] font-black border border-brand-500/20 uppercase tracking-tighter">SOPORTE</span>
                            @endif
                            <span class="text-[10px] font-bold text-gray-500 uppercase tracking-widest">{{ $msg->user->name }}</span>
                            <span class="text-[10px] text-gray-600">{{ $msg->created_at->format('H:i') }}</span>
                        </div>
                        <div class="max-w-[85%] p-5 rounded-[2rem] shadow-lg
                            {{ $isMe ? 'bg-brand-600 text-white rounded-tr-none' : ($isAdmin ? 'bg-[#1a1c25] border-2 border-brand-500/20 text-gray-200 rounded-tl-none' : 'bg-gray-900 border border-gray-800 text-gray-300 rounded-tl-none') }}">
                            <p class="text-sm leading-relaxed whitespace-pre-wrap">{{ $msg->message }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Input de Respuesta -->
            @if($ticket->status !== 'cerrado')
                <div class="p-6 bg-gray-900/40 border-t border-gray-800/50 backdrop-blur-sm">
                    <form action="{{ route('ticket.messages.store', $ticket) }}" method="POST" class="bg-[#0a0c10] border-2 border-gray-800/80 rounded-[2rem] p-2 flex items-end gap-2 focus-within:border-brand-500/50 transition-all shadow-inner">
                        @csrf
                        <textarea name="message" rows="1" class="flex-1 bg-transparent border-0 focus:ring-0 text-white placeholder-gray-600 py-3 px-5 resize-none min-h-[52px] max-h-[150px] custom-scrollbar" placeholder="Escribe tu respuesta..." required oninput="this.style.height = '';this.style.height = this.scrollHeight + 'px'"></textarea>
                        <button type="submit" class="w-12 h-12 bg-brand-600 text-white rounded-2xl hover:bg-brand-500 transition-all flex items-center justify-center shrink-0 shadow-lg shadow-brand-500/20 transform active:scale-95">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                        </button>
                    </form>
                    @error('message') <p class="mt-2 text-xs text-red-500 ml-6">{{ $message }}</p> @enderror
                </div>
            @else
                <div class="p-10 bg-gray-900/40 border-t border-gray-800/50 backdrop-blur-sm text-center">
                    <div class="inline-flex items-center gap-3 text-gray-500 bg-gray-900/50 px-6 py-3 rounded-2xl border border-gray-800/50">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        <span class="text-sm font-bold uppercase tracking-wider">Conversación Finalizada</span>
                    </div>
                </div>
            @endif
        </div>

        <!-- Panel Lateral -->
        <div class="w-full lg:w-80 shrink-0 space-y-6">
            
            <!-- Detalles Info -->
            <div class="bg-[#11131a] border border-gray-800/60 rounded-3xl p-7 shadow-xl overflow-hidden relative group">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-brand-600/5 rounded-full blur-[40px] group-hover:bg-brand-600/10 transition-colors"></div>
                
                <h3 class="text-xs font-black text-gray-500 uppercase tracking-[0.2em] mb-6 relative z-10">Información del Ticket</h3>
                
                <div class="space-y-6 relative z-10">
                    <div class="flex flex-col gap-1">
                        <span class="text-[10px] font-bold text-gray-600 uppercase">Solicitante</span>
                        <div class="flex items-center gap-3 mt-1">
                            <div class="w-9 h-9 rounded-xl bg-gray-900 border border-gray-800 flex items-center justify-center text-brand-400 font-bold text-sm">
                                {{ substr($ticket->user->name, 0, 2) }}
                            </div>
                            <div class="flex flex-col">
                                <span class="text-sm font-bold text-white">{{ $ticket->user->name }}</span>
                                <span class="text-[10px] text-gray-500">{{ $ticket->user->email }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-4">
                        <div class="flex flex-col gap-1">
                            <span class="text-[10px] font-bold text-gray-600 uppercase">Número</span>
                            <span class="text-sm font-black text-white">#{{ str_pad($ticket->id, 5, '0', STR_PAD_LEFT) }}</span>
                        </div>
                        <div class="flex flex-col gap-1">
                            <span class="text-[10px] font-bold text-gray-600 uppercase">Actualizado</span>
                            <span class="text-xs font-bold text-gray-400">{{ $ticket->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Controles Administración -->
            @if(Auth::user()->role === 'admin')
                <div class="bg-[#11131a] border border-brand-500/20 rounded-3xl p-7 shadow-xl relative overflow-hidden group">
                    <div class="absolute inset-0 bg-brand-600/5 opacity-0 group-hover:opacity-100 transition-opacity"></div>
                    <h3 class="text-xs font-black text-brand-400 uppercase tracking-[0.2em] mb-6 relative z-10">Gestión de Soporte</h3>
                    
                    <form action="{{ route('tickets.update', $ticket) }}" method="POST" class="space-y-5 relative z-10">
                        @csrf
                        @method('PATCH')
                        
                        <div class="space-y-2">
                            <label class="text-[10px] font-bold text-gray-500 uppercase ml-1">Cambiar Estado</label>
                            <select name="status" class="w-full bg-[#0a0c10] border-gray-800 text-sm font-bold text-white rounded-xl focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 cursor-pointer transition-all">
                                <option value="abierto" {{ $ticket->status == 'abierto' ? 'selected' : '' }}>Abierto / Nuevo</option>
                                <option value="en_proceso" {{ $ticket->status == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                                <option value="cerrado" {{ $ticket->status == 'cerrado' ? 'selected' : '' }}>Marcar como Cerrado</option>
                            </select>
                        </div>

                        <button type="submit" class="w-full py-3.5 bg-brand-600/20 text-brand-400 border border-brand-500/30 font-black rounded-xl hover:bg-brand-600 hover:text-white transition-all shadow-lg active:scale-[0.98]">
                            Actualizar Ticket
                        </button>
                    </form>
                </div>
            @endif

        </div>

    </div>

</div>
@endsection
