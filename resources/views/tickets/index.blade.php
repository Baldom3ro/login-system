<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-slate-800 leading-tight">
                {{ __('Tickets de Soporte') }}
            </h2>
            <a href="{{ route('tickets.create') }}" class="inline-flex items-center px-5 py-2.5 bg-slate-900 border border-transparent rounded-xl font-medium text-sm text-white shadow-sm hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-500 focus:ring-offset-2 transition-all duration-200">
                + Nuevo Ticket
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session('success'))
                <div class="mb-6 p-4 bg-emerald-50 border border-emerald-100 rounded-xl text-emerald-600 font-medium flex items-center shadow-sm">
                    <svg class="w-5 h-5 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm rounded-2xl border border-slate-100 overflow-hidden">
                @if($tickets->isEmpty())
                    <div class="p-12 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-slate-50 mb-4">
                            <svg class="w-8 h-8 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path></svg>
                        </div>
                        <h3 class="text-lg font-medium text-slate-900">No hay tickets</h3>
                        <p class="mt-1 text-slate-500">Aún no hay tickets registrados en el sistema.</p>
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="bg-slate-50/50 border-b border-slate-100 text-xs uppercase tracking-wider text-slate-500 font-semibold">
                                    <th class="px-6 py-4">ID</th>
                                    @if(Auth::user()->role === 'admin')
                                        <th class="px-6 py-4">Usuario</th>
                                    @endif
                                    <th class="px-6 py-4">Asunto</th>
                                    <th class="px-6 py-4">Estado</th>
                                    <th class="px-6 py-4">Actualizado</th>
                                    <th class="px-6 py-4 text-right">Acción</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100">
                                @foreach($tickets as $ticket)
                                    <tr class="hover:bg-slate-50/50 transition-colors duration-200">
                                        <td class="px-6 py-4 text-sm text-slate-500 font-medium">#{{ $ticket->id }}</td>
                                        @if(Auth::user()->role === 'admin')
                                            <td class="px-6 py-4 text-sm text-slate-700 flex items-center gap-2">
                                                <div class="w-6 h-6 rounded-full bg-indigo-100 text-indigo-600 flex items-center justify-center font-bold text-xs uppercase">
                                                    {{ substr($ticket->user->name, 0, 1) }}
                                                </div>
                                                {{ $ticket->user->name }}
                                            </td>
                                        @endif
                                        <td class="px-6 py-4 text-sm text-slate-900 font-medium">{{ $ticket->title }}</td>
                                        <td class="px-6 py-4">
                                            @php
                                                $statusColors = [
                                                    'abierto' => 'bg-blue-50 text-blue-700 border-blue-200',
                                                    'en_proceso' => 'bg-amber-50 text-amber-700 border-amber-200',
                                                    'cerrado' => 'bg-slate-50 text-slate-600 border-slate-200',
                                                ];
                                                $color = $statusColors[$ticket->status] ?? 'bg-slate-50 text-slate-700';
                                            @endphp
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-md text-xs font-semibold border {{ $color }}">
                                                {{ ucfirst(str_replace('_', ' ', $ticket->status)) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-slate-500">{{ $ticket->updated_at->diffForHumans() }}</td>
                                        <td class="px-6 py-4 text-right">
                                            <a href="{{ route('tickets.show', $ticket) }}" class="inline-flex items-center justify-center w-8 h-8 rounded-full bg-white border border-slate-200 text-slate-600 hover:text-indigo-600 hover:border-indigo-200 hover:bg-indigo-50 shadow-sm transition-all duration-200">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
