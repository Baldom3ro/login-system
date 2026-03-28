<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-slate-800 leading-tight">
            {{ __('Abrir Consulta') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm rounded-2xl border border-slate-100 overflow-hidden text-slate-800">
                <div class="p-8">
                    <div class="mb-8">
                        <h3 class="text-lg font-bold text-slate-900">Detalles del Ticket</h3>
                        <p class="text-sm text-slate-500 mt-1">Proporciona tanta información como sea posible para que podamos ayudarte rápido.</p>
                    </div>
                    
                    <form action="{{ route('tickets.store') }}" method="POST" class="space-y-6">
                        @csrf
                        <div>
                            <label for="title" class="block text-sm font-medium text-slate-700 mb-2">Asunto Principal</label>
                            <input type="text" id="title" name="title" value="{{ old('title') }}" required autofocus
                                class="w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-colors bg-slate-50 hover:bg-white px-4 py-3" 
                                placeholder="Ej. Problema con mi acceso">
                            @error('title') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-slate-700 mb-2">Mensaje Detallado</label>
                            <textarea id="description" name="description" required rows="6"
                                class="w-full rounded-xl border-slate-200 shadow-sm focus:border-indigo-500 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 transition-colors bg-slate-50 hover:bg-white px-4 py-3 resize-none" 
                                placeholder="Explica detalladamente la situación que estás presentando...">{{ old('description') }}</textarea>
                            @error('description') <p class="mt-2 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="flex items-center justify-end pt-4 border-t border-slate-100 mt-6 gap-3">
                            <a href="{{ route('tickets.index') }}" class="px-5 py-2.5 text-sm font-medium text-slate-600 hover:text-slate-900 bg-white border border-slate-200 hover:bg-slate-50 rounded-xl transition-colors">
                                Cancelar
                            </a>
                            <button type="submit" class="px-5 py-2.5 text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 rounded-xl shadow-sm hover:shadow-md transition-all">
                                Enviar Ticket
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
