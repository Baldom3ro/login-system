<section>
    <header>
        <h2 class="text-xl font-bold text-white tracking-tight">
            {{ __('Sesiones de Navegador') }}
        </h2>

        <p class="mt-2 text-sm text-gray-500 font-medium leading-relaxed">
            Maneja y cierra tus sesiones activas en otros navegadores y dispositivos para mayor seguridad.
        </p>
    </header>

    <div class="mt-8 space-y-4">
        @foreach ($sessions as $session)
            <div class="flex items-center p-4 bg-[#0a0c10] border border-gray-800 rounded-2xl gap-4">
                <div class="w-12 h-12 rounded-xl bg-gray-900 border border-gray-800 flex items-center justify-center text-gray-500">
                    @if ($session->agent && str_contains(strtolower($session->agent), 'mobile'))
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                    @else
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L9 20l-1 1h8l-1-1-.75-3M3 13h18M5 17h14a2 2 0 002-2V5a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                    @endif
                </div>
                
                <div class="flex-1">
                    <div class="text-sm font-bold text-white">
                        {{ $session->agent ?: 'Dispositivo Desconocido' }}
                    </div>
                    <div class="text-[11px] font-medium text-gray-500 mt-0.5">
                        {{ $session->ip_address }} &bull; 
                        @if ($session->is_current_device)
                            <span class="text-emerald-500">Sesión actual</span>
                        @else
                            Última actividad: {{ $session->last_active }}
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <form method="post" action="{{ route('profile.sessions.destroy') }}" class="mt-10 pt-8 border-t border-gray-800/50">
        @csrf
        @method('delete')

        <div class="max-w-md space-y-3">
            <label for="password_sessions" class="block text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">Confirmar Contraseña</label>
            <input
                id="password_sessions"
                name="password"
                type="password"
                class="w-full bg-[#0a0c10] border-2 border-gray-800 rounded-2xl py-3 px-4 text-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all font-semibold"
                placeholder="Ingresa tu contraseña para confirmar"
                required
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center gap-6 mt-8">
            <button type="submit" class="px-8 py-3.5 bg-gray-900 text-white border border-gray-800 font-bold rounded-xl hover:bg-gray-800 hover:border-gray-700 transition-all transform active:scale-[0.98]">
                {{ __('Cerrar otras sesiones') }}
            </button>

            @if (session('status') === 'other-sessions-deleted')
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="flex items-center gap-2 text-emerald-400 font-bold text-sm"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                    {{ __('Sesiones cerradas') }}
                </div>
            @endif
        </div>
    </form>
</section>
