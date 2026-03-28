@extends('layouts.dashboard')

@section('title', 'Configuración de Perfil')

@section('content')
<div class="max-w-[1400px] mx-auto space-y-10">
    
    <div class="mb-10">
        <h3 class="text-3xl font-black text-white tracking-tight">Mi Cuenta</h3>
        <p class="text-gray-500 mt-2 font-medium">Gestiona tu información personal, seguridad y sesiones de dispositivo.</p>
    </div>

    <!-- Información de Perfil -->
    <div class="bg-[#11131a] border border-gray-800/60 rounded-[2.5rem] p-8 lg:p-12 shadow-2xl relative overflow-hidden group">
        <div class="absolute -top-24 -right-24 w-64 h-64 bg-brand-600/5 rounded-full blur-[80px]"></div>
        <div class="max-w-xl relative z-10">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <!-- Actualizar Contraseña -->
    <div class="bg-[#11131a] border border-gray-800/60 rounded-[2.5rem] p-8 lg:p-12 shadow-2xl relative overflow-hidden group">
        <div class="absolute -bottom-24 -left-24 w-64 h-64 bg-blue-600/5 rounded-full blur-[80px]"></div>
        <div class="max-w-xl relative z-10">
            @include('profile.partials.update-password-form')
        </div>
    </div>

    <!-- Sesiones de Navegador -->
    <div class="bg-[#11131a] border border-gray-800/60 rounded-[2.5rem] p-8 lg:p-12 shadow-2xl relative overflow-hidden">
        <div class="max-w-xl relative z-10">
            @include('profile.partials.manage-sessions-form')
        </div>
    </div>

    <!-- Eliminar Cuenta -->
    <div class="bg-[#11131a] border border-red-500/10 rounded-[2.5rem] p-8 lg:p-12 shadow-2xl relative overflow-hidden group">
        <div class="absolute inset-0 bg-red-500/[0.02] opacity-0 group-hover:opacity-100 transition-opacity"></div>
        <div class="max-w-xl relative z-10">
            @include('profile.partials.delete-user-form')
        </div>
    </div>

</div>
@endsection
