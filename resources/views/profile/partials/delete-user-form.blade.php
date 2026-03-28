<section class="space-y-6">
    <header>
        <h2 class="text-xl font-bold text-red-500 tracking-tight">
            {{ __('Eliminar Cuenta') }}
        </h2>

        <p class="mt-2 text-sm text-gray-500 font-medium leading-relaxed">
            {{ __('Una vez que se elimine tu cuenta, todos sus recursos y datos se borrarán permanentemente. Antes de eliminar tu cuenta, descarga cualquier dato o información que desees conservar.') }}
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="px-8 py-3.5 bg-red-600/10 text-red-500 border border-red-500/20 font-black rounded-xl hover:bg-red-600 hover:text-white transition-all transform active:scale-[0.98]"
    >{{ __('Eliminar Cuenta') }}</button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-10 bg-[#11131a] text-white">
            @csrf
            @method('delete')

            <h2 class="text-2xl font-black text-white tracking-tight">
                {{ __('¿Estás seguro de que deseas eliminar tu cuenta?') }}
            </h2>

            <p class="mt-4 text-sm text-gray-500 font-medium leading-relaxed">
                {{ __('Esta acción es irreversible. Por favor, ingresa tu contraseña para confirmar que deseas eliminar permanentemente tu cuenta.') }}
            </p>

            <div class="mt-8 space-y-2">
                <label for="password" class="block text-xs font-bold text-gray-400 uppercase tracking-widest ml-1">{{ __('Contraseña') }}</label>
                <input
                    id="password"
                    name="password"
                    type="password"
                    class="w-full bg-[#0a0c10] border-2 border-gray-800 rounded-2xl py-3 px-4 text-white focus:border-red-500 focus:ring-4 focus:ring-red-500/10 transition-all font-semibold"
                    placeholder="{{ __('Contraseña') }}"
                />
                <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2" />
            </div>

            <div class="mt-10 flex justify-end gap-4">
                <button type="button" x-on:click="$dispatch('close')" class="px-6 py-3 text-gray-400 hover:text-white font-bold transition-all">
                    {{ __('Cancelar') }}
                </button>

                <button type="submit" class="px-8 py-3.5 bg-red-600 text-white font-black rounded-xl shadow-lg shadow-red-500/20 hover:bg-red-500 transition-all transform active:scale-[0.98]">
                    {{ __('Confirmar Eliminación') }}
                </button>
            </div>
        </form>
    </x-modal>
</section>
