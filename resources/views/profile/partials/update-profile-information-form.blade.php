<section>
    <header>
        <h2 class="text-xl font-bold text-white tracking-tight">
            {{ __('Información de Perfil') }}
        </h2>

        <p class="mt-2 text-sm text-gray-500 font-medium leading-relaxed">
            {{ __("Actualiza la información de tu cuenta y tu dirección de correo electrónico.") }}
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="mt-8 space-y-8">
        @csrf
        @method('patch')

        <div class="space-y-2">
            <label for="name" class="block text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">{{ __('Nombre') }}</label>
            <input id="name" name="name" type="text" class="w-full bg-[#0a0c10] border-2 border-gray-800 rounded-2xl py-3 px-4 text-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all font-semibold" value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div class="space-y-2">
            <label for="email" class="block text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">{{ __('Correo Electrónico') }}</label>
            <input id="email" name="email" type="email" class="w-full bg-[#0a0c10] border-2 border-gray-800 rounded-2xl py-3 px-4 text-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all font-semibold" value="{{ old('email', $user->email) }}" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-4 p-4 bg-yellow-500/5 border border-yellow-500/20 rounded-2xl">
                    <p class="text-xs font-bold text-yellow-500/80 uppercase tracking-wider mb-2">
                        {{ __('Correo no verificado') }}
                    </p>

                    <button form="send-verification" class="text-brand-400 hover:text-brand-300 text-sm font-bold underline transition-colors">
                        {{ __('Haz clic aquí para reenviar el correo de verificación.') }}
                    </button>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-3 font-bold text-xs text-emerald-400 bg-emerald-500/10 p-2 rounded-lg inline-block">
                            {{ __('Se ha enviado un nuevo enlace de verificación.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <div class="flex items-center gap-6 pt-4">
            <button type="submit" class="px-10 py-3.5 bg-brand-600 text-white font-black rounded-xl shadow-lg shadow-brand-500/20 hover:bg-brand-500 transition-all transform active:scale-[0.98]">
                {{ __('Guardar Cambios') }}
            </button>

            @if (session('status') === 'profile-updated')
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="flex items-center gap-2 text-emerald-400 font-bold text-sm"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                    {{ __('Guardado') }}
                </div>
            @endif
        </div>
    </form>
</section>
