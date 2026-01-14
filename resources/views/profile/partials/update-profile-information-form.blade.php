<section>
    <header class="mb-4">
        <h3 class="mb-2" style="font-family: 'Playfair Display', serif; color: var(--accent-rose); font-size: 1.5rem;">
            <i class="bi bi-info-circle me-2"></i>Información Personal
        </h3>
        <p class="text-muted mb-0">
            Actualiza la información de tu perfil y dirección de correo electrónico.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}">
        @csrf
        @method('patch')

        <div class="row mb-3">
            <div class="col-md-6">
                <label for="name" class="form-label">
                    <i class="bi bi-person me-1"></i>Nombre Completo
                </label>
                <input type="text" 
                       class="form-control @error('name') is-invalid @enderror" 
                       id="name" 
                       name="name" 
                       value="{{ old('name', $user->name) }}" 
                       required 
                       autofocus 
                       autocomplete="name"
                       placeholder="Ingresa tu nombre">
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6">
                <label for="email" class="form-label">
                    <i class="bi bi-envelope me-1"></i>Correo Electrónico
                </label>
                <input type="email" 
                       class="form-control @error('email') is-invalid @enderror" 
                       id="email" 
                       name="email" 
                       value="{{ old('email', $user->email) }}" 
                       required 
                       autocomplete="username"
                       placeholder="tu@email.com">
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror

                @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                    <div class="mt-2">
                        <div class="alert alert-warning alert-spa">
                            <i class="bi bi-exclamation-triangle-fill me-2"></i>
                            <strong>Tu correo electrónico no está verificado.</strong>
                            <form method="POST" action="{{ route('verification.send') }}" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link p-0 text-decoration-underline ms-1">
                                    Haz clic aquí para reenviar el correo de verificación.
                                </button>
                            </form>
                        </div>

                        @if (session('status') === 'verification-link-sent')
                            <div class="alert alert-success alert-spa mt-2">
                                <i class="bi bi-check-circle-fill me-2"></i>
                                Se ha enviado un nuevo enlace de verificación a tu dirección de correo electrónico.
                            </div>
                        @endif
                    </div>
                @endif
            </div>
        </div>

        <div class="d-flex align-items-center gap-3 mt-4">
            <button type="submit" class="btn btn-spa-primary">
                <i class="bi bi-check-circle me-1"></i>Guardar Cambios
            </button>

            @if (session('status') === 'profile-updated')
                <div class="alert alert-success alert-spa mb-0" style="padding: 0.5rem 1rem;">
                    <i class="bi bi-check-circle-fill me-1"></i>Guardado correctamente.
                </div>
            @endif
        </div>
    </form>
</section>
