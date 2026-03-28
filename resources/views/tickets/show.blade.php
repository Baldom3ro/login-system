<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center gap-4">
            <a href="{{ route('tickets.index') }}" class="text-slate-400 hover:text-slate-600 transition">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            </a>
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                {{ __('Ticket #') }}{{ $ticket->id }}
            </h2>
        </div>
    </x-slot>

    <div class="py-8 bg-slate-50/50 min-h-[calc(100vh-130px)]">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8 flex flex-col md:flex-row gap-8">
            
            <!-- Hilo de Conversación (Chat UI) -->
            <div class="flex-1 space-y-6 flex flex-col">
                <!-- Ticket Original (Primer mensaje simulado) -->
                <div class="flex flex-col gap-1 w-full max-w-[90%] md:max-w-[85%] @if(Auth::id() === $ticket->user_id) self-end @else self-start @endif">
                    <span class="text-xs text-slate-500 font-medium px-2 @if(Auth::id() === $ticket->user_id) text-right @endif">
                        {{ $ticket->user->name }} &bull; {{ $ticket->created_at->format('d M H:i') }}
                    </span>
                    <div class="p-5 rounded-3xl shadow-sm @if(Auth::id() === $ticket->user_id) bg-indigo-600 text-white rounded-tr-none @else bg-white border border-slate-200 text-slate-800 rounded-tl-none @endif">
                        <h4 class="font-bold mb-2 text-base @if(Auth::id() === $ticket->user_id) text-indigo-100 @else text-slate-900 @endif">{{ $ticket->title }}</h4>
                        <p class="whitespace-pre-wrap text-sm leading-relaxed opacity-95">{{ $ticket->description }}</p>
                    </div>
                </div>

                <!-- Historial de Respuestas -->
                @foreach($ticket->messages as $msg)
                    @php
                        $isMe = Auth::id() === $msg->user_id;
                        $isAdmin = $msg->user->role === 'admin';
                    @endphp
                    <div class="flex flex-col gap-1 w-full max-w-[90%] md:max-w-[85%] {{ $isMe ? 'self-end' : 'self-start' }}">
                        <span class="text-xs font-medium px-2 flex items-center gap-1 {{ $isMe ? 'justify-end text-slate-500' : 'text-slate-500' }}">
                            {{ $isAdmin && !$isMe ? '🛡️ Soporte (' . $msg->user->name . ')' : $msg->user->name }} 
                            <span class="opacity-50">&bull; {{ $msg->created_at->format('d M H:i') }}</span>
                        </span>
                        
                        <div class="p-5 rounded-3xl shadow-sm text-sm leading-relaxed
                            {{ $isMe ? 'bg-indigo-600 text-white rounded-tr-none' : ($isAdmin ? 'bg-white border-2 border-indigo-100 text-slate-800 rounded-tl-none' : 'bg-white border border-slate-200 text-slate-800 rounded-tl-none') }}">
                            <p class="whitespace-pre-wrap opacity-95">{{ $msg->message }}</p>
                        </div>
                    </div>
                @endforeach

                <!-- Formulario de Respuesta -->
                @if($ticket->status !== 'cerrado')
                    <div class="mt-8 pt-6 self-stretch">
                        <form action="{{ route('ticket.messages.store', $ticket) }}" method="POST" class="bg-white p-2.5 rounded-3xl shadow-sm border border-slate-200 flex gap-3 items-end transition-all focus-within:shadow-md focus-within:border-indigo-300">
                            @csrf
                            <textarea name="message" rows="1" class="w-full border-0 focus:ring-0 resize-none bg-transparent py-3 px-4 text-slate-700 min-h-[52px] max-h-[200px]" placeholder="Escribe tu respuesta aquí..." required oninput="this.style.height = '';this.style.height = this.scrollHeight + 'px'"></textarea>
                            <button type="submit" class="w-12 h-12 shrink-0 mb-0.5 mr-0.5 bg-indigo-600 text-white rounded-2xl hover:bg-indigo-700 hover:shadow-md transition-all flex items-center justify-center">
                                <svg class="w-5 h-5 transform rotate-90 ml-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19V6m0 0l-8 8m8-8l8 8"></path></svg>
                            </button>
                        </form>
                        @error('message') <p class="mt-2 text-xs text-red-600 px-4">{{ $message }}</p> @enderror
                    </div>
                @else
                    <div class="mt-8 flex flex-col items-center justify-center p-8 bg-slate-100 border border-slate-200 rounded-3xl text-slate-500 self-stretch text-sm">
                        <svg class="w-10 h-10 mb-3 opacity-40 text-slate-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                        <span class="font-medium text-slate-600">Este ticket ha sido cerrado</span>
                        <span class="mt-1 opacity-75">No se pueden agregar nuevos mensajes a esta conversación.</span>
                    </div>
                @endif
            </div>

            <!-- Panel Lateral (Detalles y Controles Admin) -->
            <div class="w-full md:w-80 shrink-0 space-y-6">
                <!-- Info Status -->
                <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-6">
                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-wider mb-5">Información</h3>
                    
                    <div class="space-y-4 text-sm">
                        <div class="flex justify-between items-center pb-4 border-b border-slate-50">
                            <span class="text-slate-500 font-medium">Estado</span>
                            @php
                                $statusColors = [
                                    'abierto' => 'bg-blue-50 text-blue-700 border border-blue-100',
                                    'en_proceso' => 'bg-amber-50 text-amber-700 border border-amber-100',
                                    'cerrado' => 'bg-slate-50 text-slate-600 border border-slate-200',
                                ];
                                $color = $statusColors[$ticket->status] ?? 'bg-slate-50 text-slate-600';
                            @endphp
                            <span class="px-3 py-1.5 rounded-lg text-xs font-bold shadow-sm {{ $color }}">
                                {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                            </span>
                        </div>
                        
                        <div class="flex flex-col pb-4 border-b border-slate-50">
                            <span class="text-slate-500 font-medium mb-1.5">Usuario</span>
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-full bg-slate-100 text-slate-600 flex items-center justify-center font-bold text-xs uppercase">
                                    {{ substr($ticket->user->name, 0, 1) }}
                                </div>
                                <div class="flex flex-col">
                                    <span class="font-bold text-slate-800">{{ $ticket->user->name }}</span>
                                    <span class="text-[11px] text-slate-500">{{ $ticket->user->email }}</span>
                                </div>
                            </div>
                        </div>

                        <div class="flex justify-between items-center pt-1">
                            <span class="text-slate-500 font-medium">Actualizado</span>
                            <span class="text-slate-700 font-semibold text-xs bg-slate-50 px-2 py-1 rounded-md">{{ $ticket->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>

                <!-- Admin Controls -->
                @if(Auth::user()->role === 'admin')
                <div class="bg-white rounded-3xl shadow-sm border border-indigo-100 p-6 relative overflow-hidden group hover:border-indigo-200 transition-colors">
                    <div class="absolute -top-4 -right-4 p-4 opacity-[0.03] text-indigo-900 group-hover:scale-110 group-hover:opacity-[0.05] transition-all transform">
                        <svg class="w-32 h-32" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"></path></svg>
                    </div>
                    <h3 class="text-xs font-bold text-indigo-600 uppercase tracking-wider mb-5 relative z-10">Opciones Admin</h3>
                    
                    <form action="{{ route('tickets.update', $ticket) }}" method="POST" class="relative z-10">
                        @csrf
                        @method('PATCH')
                        <div class="mb-5">
                            <label class="block text-xs font-bold text-slate-600 mb-2">Cambiar Estado</label>
                            <select name="status" class="w-full text-sm font-medium border-slate-200 rounded-xl shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 bg-slate-50 py-2.5">
                                <option value="abierto" {{ $ticket->status == 'abierto' ? 'selected' : '' }}>Abierto</option>
                                <option value="en_proceso" {{ $ticket->status == 'en_proceso' ? 'selected' : '' }}>En Proceso</option>
                                <option value="cerrado" {{ $ticket->status == 'cerrado' ? 'selected' : '' }}>Cerrado</option>
                            </select>
                        </div>
                        <button type="submit" class="w-full py-2.5 bg-slate-900 text-white text-sm font-bold rounded-xl hover:bg-indigo-600 hover:shadow-md transition-all duration-200">
                            Aplicar Cambios
                        </button>
                    </form>
                </div>
                @endif
            </div>

        </div>
    </div>
</x-app-layout>
