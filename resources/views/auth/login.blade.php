<x-guest-layout>
    <h3 class="text-center mb-4" style="font-family: 'Playfair Display', serif; color: var(--accent-rose);">
        Iniciar Sesión
    </h3>
    
    @if (session('status'))
        <div class="alert alert-success alert-spa mb-4">
            <i class="bi bi-check-circle-fill me-2"></i>
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

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
                   autofocus 
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
                   autocomplete="current-password"
                   placeholder="Ingresa tu contraseña">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Remember Me -->
        <div class="mb-4">
            <div class="form-check">
                <input class="form-check-input" 
                       type="checkbox" 
                       id="remember" 
                       name="remember">
                <label class="form-check-label" for="remember">
                    Recordarme
                </label>
            </div>
        </div>

        <div class="d-grid gap-2 mb-3">
            <button type="submit" class="btn btn-spa-primary">
                <i class="bi bi-box-arrow-in-right me-2"></i>Iniciar Sesión
            </button>
        </div>

        @if (Route::has('password.request'))
            <div class="text-center mb-3">
                <a href="{{ route('password.request') }}" class="text-link">
                    <i class="bi bi-question-circle me-1"></i>¿Olvidaste tu contraseña?
                </a>
            </div>
        @endif

        <div class="divider">
            <span>o</span>
        </div>

        <div class="text-center">
            <p class="mb-0">
                ¿No tienes una cuenta? 
                <a href="{{ route('register') }}" class="text-link">
                    Regístrate aquí
                </a>
            </p>
        </div>
    </form>
</x-guest-layout>
