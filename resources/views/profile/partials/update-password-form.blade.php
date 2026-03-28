<section>
    <header>
        <h2 class="text-xl font-bold text-white tracking-tight">
            {{ __('Actualizar Contraseña') }}
        </h2>

        <p class="mt-2 text-sm text-gray-500 font-medium leading-relaxed">
            {{ __('Asegúrate de que tu cuenta utilice una contraseña larga y aleatoria para mantener la seguridad.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-8 space-y-8">
        @csrf
        @method('put')

        <div class="space-y-2">
            <label for="update_password_current_password" class="block text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">{{ __('Contraseña Actual') }}</label>
            <input id="update_password_current_password" name="current_password" type="password" class="w-full bg-[#0a0c10] border-2 border-gray-800 rounded-2xl py-3 px-4 text-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all font-semibold" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="space-y-2">
            <label for="update_password_password" class="block text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">{{ __('Nueva Contraseña') }}</label>
            <input id="update_password_password" name="password" type="password" class="w-full bg-[#0a0c10] border-2 border-gray-800 rounded-2xl py-3 px-4 text-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all font-semibold" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
        </div>

        <div class="space-y-2">
            <label for="update_password_password_confirmation" class="block text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">{{ __('Confirmar Contraseña') }}</label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password" class="w-full bg-[#0a0c10] border-2 border-gray-800 rounded-2xl py-3 px-4 text-white focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all font-semibold" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-6 pt-4">
            <button type="submit" class="px-10 py-3.5 bg-brand-600 text-white font-black rounded-xl shadow-lg shadow-brand-500/20 hover:bg-brand-500 transition-all transform active:scale-[0.98]">
                {{ __('Guardar Nueva Contraseña') }}
            </button>

            @if (session('status') === 'password-updated')
                <div
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="flex items-center gap-2 text-emerald-400 font-bold text-sm"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path></svg>
                    {{ __('Actualizada') }}
                </div>
            @endif
        </div>
    </form>
</section>
