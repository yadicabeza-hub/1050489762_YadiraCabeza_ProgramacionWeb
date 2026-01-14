@extends('layouts.admin')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-person-circle"></i> Mi Perfil</h1>
    <p class="text-muted mb-0">Gestiona tu información personal y configuración de cuenta</p>
</div>

<div class="row g-4">
    <!-- Información del Perfil -->
    <div class="col-12">
        <div class="card-spa">
            <div class="card-header">
                <i class="bi bi-person-badge me-2"></i>Información del Perfil
            </div>
            <div class="card-body p-4">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>
    </div>

    <!-- Actualizar Contraseña -->
    <div class="col-12">
        <div class="card-spa">
            <div class="card-header">
                <i class="bi bi-shield-lock me-2"></i>Actualizar Contraseña
            </div>
            <div class="card-body p-4">
                @include('profile.partials.update-password-form')
            </div>
        </div>
    </div>

    <!-- Eliminar Cuenta -->
    <div class="col-12">
        <div class="card-spa" style="border: 2px solid #FFB3BA;">
            <div class="card-header" style="background: linear-gradient(135deg, #FFB3BA 0%, #FF9AA2 100%);">
                <i class="bi bi-exclamation-triangle me-2"></i>Zona de Peligro
            </div>
            <div class="card-body p-4">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection
