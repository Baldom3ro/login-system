<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Browser Sessions') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            Maneja y cierra tus sesiones activas en otros navegadores y dispositivos.
        </p>
    </header>

    <div class="mt-6 space-y-4">
        @foreach ($sessions as $session)
            <div class="flex items-center">
                <div class="flex-1">
                    <div class="text-sm text-gray-600">
                        {{ $session->agent ?: 'Navegador Desconocido' }}
                    </div>
                    <div>
                        <div class="text-xs text-gray-500">
                            {{ $session->ip_address }} - 
                            @if ($session->is_current_device)
                                <span class="text-green-500 font-semibold">Este dispositivo</span>
                            @else
                                Última actividad: {{ $session->last_active }}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <form method="post" action="{{ route('profile.sessions.destroy') }}" class="mt-6">
        @csrf
        @method('delete')

        <div class="mt-4">
            <x-input-label for="password_sessions" value="Contraseña" class="sr-only" />
            <x-text-input
                id="password_sessions"
                name="password"
                type="password"
                class="mt-1 block w-3/4"
                placeholder="Ingresa tu contraseña para confirmar"
                required
            />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4 mt-4">
            <x-primary-button>{{ __('Cerrar otras sesiones') }}</x-primary-button>

            @if (session('status') === 'other-sessions-deleted')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Sesiones cerradas.') }}</p>
            @endif
        </div>
    </form>
</section>
