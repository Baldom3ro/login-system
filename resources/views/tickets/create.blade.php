@extends('layouts.dashboard')

@section('title', 'Abrir Consulta')

@section('content')
<div class="max-w-3xl mx-auto">
    <div class="mb-10">
        <h3 class="text-3xl font-black text-white tracking-tight">Nueva Solicitud</h3>
        <p class="text-gray-500 mt-2 font-medium">Describe tu inconveniente con detalle para recibir asistencia técnica personalizada.</p>
    </div>

    <div class="relative">
        <!-- Glow effect behind card -->
        <div class="absolute -inset-1 bg-gradient-to-r from-brand-600/20 to-blue-600/20 rounded-[2.5rem] blur-2xl opacity-50"></div>
        
        <div class="relative bg-[#11131a] border border-gray-800/60 rounded-[2.5rem] p-8 lg:p-12 shadow-2xl overflow-hidden">
            <!-- Decorative circle -->
            <div class="absolute -top-24 -right-24 w-64 h-64 bg-brand-600/5 rounded-full blur-[80px]"></div>
            
            <form action="{{ route('tickets.store') }}" method="POST" class="space-y-8 relative z-10">
                @csrf
                
                <div class="space-y-3">
                    <label for="title" class="block text-sm font-bold text-gray-400 uppercase tracking-[0.15em] ml-1">Asunto de la Consulta</label>
                    <div class="relative group">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none text-gray-500 group-focus-within:text-brand-400 transition-colors">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                        </div>
                        <input type="text" id="title" name="title" value="{{ old('title') }}" required autofocus
                            class="w-full bg-[#0a0c10] border-2 border-gray-800/80 rounded-2xl py-4 pl-12 pr-4 text-white placeholder-gray-600 focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all text-lg font-semibold" 
                            placeholder="Ej. Error al procesar el pago">
                    </div>
                    @error('title') <p class="mt-2 text-sm text-red-500 font-bold flex items-center gap-1"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg> {{ $message }}</p> @enderror
                </div>

                <div class="space-y-3">
                    <label for="description" class="block text-sm font-bold text-gray-400 uppercase tracking-[0.15em] ml-1">Descripción Detallada</label>
                    <div class="relative group">
                        <textarea id="description" name="description" required rows="6"
                            class="w-full bg-[#0a0c10] border-2 border-gray-800/80 rounded-2xl py-4 px-5 text-white placeholder-gray-600 focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all text-base leading-relaxed resize-none custom-scrollbar" 
                            placeholder="Explica qué sucede, cuándo comenzó y qué pasos has intentado realizar...">{{ old('description') }}</textarea>
                    </div>
                    @error('description') <p class="mt-2 text-sm text-red-500 font-bold flex items-center gap-1"><svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M18 10a8 8 0 11-16 0 8 8 0 0116 0zm-7 4a1 1 0 11-2 0 1 1 0 012 0zm-1-9a1 1 0 00-1 1v4a1 1 0 102 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path></svg> {{ $message }}</p> @enderror
                </div>

                <div class="flex items-center justify-between pt-6 border-t border-gray-800/50 mt-4">
                    <a href="{{ route('tickets.index') }}" class="px-6 py-3 text-gray-400 hover:text-white font-bold transition-all flex items-center gap-2 group">
                        <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                        Cancelar
                    </a>
                    <button type="submit" class="px-10 py-4 bg-brand-600 text-white font-black rounded-2xl shadow-xl shadow-brand-500/20 hover:bg-brand-500 hover:shadow-brand-500/40 transition-all transform hover:-translate-y-1">
                        Enviar Solicitud
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
