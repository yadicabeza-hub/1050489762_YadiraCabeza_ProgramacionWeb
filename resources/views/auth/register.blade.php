<x-guest-layout>
    <h3 class="text-center mb-4" style="font-family: 'Playfair Display', serif; color: var(--accent-rose);">
        Crear Nueva Cuenta
    </h3>
    
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="mb-3">
            <label for="name" class="form-label">
                <i class="bi bi-person me-1"></i>Nombre Completo
            </label>
            <input type="text" 
                   class="form-control @error('name') is-invalid @enderror" 
                   id="name" 
                   name="name" 
                   value="{{ old('name') }}" 
                   required 
                   autofocus 
                   autocomplete="name"
                   placeholder="Ingresa tu nombre completo">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Email Address -->
        <div class="mb-3">
            <label for="email" class="form-label">
                <i class="bi bi-envelope me-1"></i>Correo Electrónico
            </label>
            <input type="email" 
                   class="form-control @error('email') is-invalid @enderror" 
                   id="email" 
                   name="email" 
                   value="{{ old('email') }}" 
                   required 
                   autocomplete="username"
                   placeholder="tu@email.com">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label">
                <i class="bi bi-lock me-1"></i>Contraseña
            </label>
            <input type="password" 
                   class="form-control @error('password') is-invalid @enderror" 
                   id="password" 
                   name="password" 
                   required 
                   autocomplete="new-password"
                   placeholder="Mínimo 8 caracteres">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="form-label">
                <i class="bi bi-lock-fill me-1"></i>Confirmar Contraseña
            </label>
            <input type="password" 
                   class="form-control" 
                   id="password_confirmation" 
                   name="password_confirmation" 
                   required 
                   autocomplete="new-password"
                   placeholder="Repite tu contraseña">
        </div>

        <div class="d-grid gap-2">
            <button type="submit" class="btn btn-spa-primary">
                <i class="bi bi-person-plus me-2"></i>Registrarse
            </button>
        </div>

        <div class="divider">
            <span>o</span>
        </div>

        <div class="text-center">
            <p class="mb-0">
                ¿Ya tienes una cuenta? 
                <a href="{{ route('login') }}" class="text-link">
                    Inicia sesión aquí
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
