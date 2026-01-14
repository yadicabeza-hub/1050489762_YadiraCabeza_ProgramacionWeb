<section>
    <header class="mb-4">
        <h3 class="mb-2" style="font-family: 'Playfair Display', serif; color: var(--accent-rose); font-size: 1.5rem;">
            <i class="bi bi-key me-2"></i>Cambiar Contraseña
        </h3>
        <p class="text-muted mb-0">
            Asegúrate de usar una contraseña larga y segura para mantener tu cuenta protegida.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}">
        @csrf
        @method('put')

        <div class="mb-3">
            <label for="update_password_current_password" class="form-label">
                <i class="bi bi-lock me-1"></i>Contraseña Actual
            </label>
            <input type="password" 
                   class="form-control @error('current_password', 'updatePassword') is-invalid @enderror" 
                   id="update_password_current_password" 
                   name="current_password" 
                   autocomplete="current-password"
                   placeholder="Ingresa tu contraseña actual">
            @error('current_password', 'updatePassword')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="update_password_password" class="form-label">
                    <i class="bi bi-lock-fill me-1"></i>Nueva Contraseña
                </label>
                <input type="password" 
                       class="form-control @error('password', 'updatePassword') is-invalid @enderror" 
                       id="update_password_password" 
                       name="password" 
                       autocomplete="new-password"
                       placeholder="Ingresa tu nueva contraseña">
                @error('password', 'updatePassword')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="update_password_password_confirmation" class="form-label">
                    <i class="bi bi-lock-fill me-1"></i>Confirmar Nueva Contraseña
                </label>
                <input type="password" 
                       class="form-control" 
                       id="update_password_password_confirmation" 
                       name="password_confirmation" 
                       autocomplete="new-password"
                       placeholder="Confirma tu nueva contraseña">
            </div>
        </div>

        <div class="d-flex align-items-center gap-3 mt-4">
            <button type="submit" class="btn btn-spa-primary">
                <i class="bi bi-check-circle me-1"></i>Guardar Contraseña
            </button>

            @if (session('status') === 'password-updated')
                <div class="alert alert-success alert-spa mb-0" style="padding: 0.5rem 1rem;">
                    <i class="bi bi-check-circle-fill me-1"></i>Contraseña actualizada correctamente.
                </div>
            @endif
        </div>
    </form>
</section>
