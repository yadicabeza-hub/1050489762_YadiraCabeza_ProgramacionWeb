<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }} - SPA & Masajes</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
    <!-- Google Fonts - Estilo femenino -->
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --primary-pink: #F8BBD9;
            --secondary-pink: #FFE5F1;
            --accent-rose: #FF6B9D;
            --soft-lavender: #E8D5FF;
            --warm-peach: #FFD4B3;
            --cream: #FFF8F3;
            --text-dark: #4A4A4A;
            --text-light: #8B8B8B;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--cream) 0%, var(--secondary-pink) 50%, var(--soft-lavender) 100%);
            color: var(--text-dark);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 2rem;
        }
        
        .auth-container {
            max-width: 450px;
            width: 100%;
        }
        
        .auth-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(248, 187, 217, 0.3);
            overflow: hidden;
            animation: fadeInUp 0.6s ease;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .auth-header {
            background: linear-gradient(135deg, var(--primary-pink) 0%, var(--accent-rose) 100%);
            color: white;
            padding: 2.5rem 2rem;
            text-align: center;
        }
        
        .auth-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            margin: 0;
            font-weight: 700;
        }
        
        .auth-header p {
            margin: 0.5rem 0 0 0;
            opacity: 0.9;
            font-size: 0.95rem;
        }
        
        .auth-body {
            padding: 2.5rem 2rem;
        }
        
        .form-label {
            font-weight: 500;
            color: var(--text-dark);
            margin-bottom: 0.5rem;
            font-size: 0.9rem;
        }
        
        .form-control,
        .form-select {
            border: 2px solid #E8E8E8;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }
        
        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-pink);
            box-shadow: 0 0 0 0.2rem rgba(248, 187, 217, 0.25);
            outline: none;
        }
        
        .btn-spa-primary {
            background: linear-gradient(135deg, var(--primary-pink) 0%, var(--accent-rose) 100%);
            border: none;
            color: white;
            padding: 0.75rem 2rem;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
            width: 100%;
            font-size: 1rem;
        }
        
        .btn-spa-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(248, 187, 217, 0.4);
            color: white;
        }
        
        .btn-spa-secondary {
            background: var(--soft-lavender);
            border: none;
            color: var(--text-dark);
            padding: 0.75rem 2rem;
            border-radius: 25px;
            font-weight: 500;
            width: 100%;
        }
        
        .alert-spa {
            border-radius: 12px;
            border: none;
            padding: 1rem;
            margin-bottom: 1.5rem;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, #FFB3BA 0%, #FF9AA2 100%);
            color: #8B0000;
        }
        
        .text-link {
            color: var(--accent-rose);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .text-link:hover {
            color: var(--primary-pink);
            text-decoration: underline;
        }
        
        .divider {
            text-align: center;
            margin: 1.5rem 0;
            position: relative;
        }
        
        .divider::before {
            content: '';
            position: absolute;
            left: 0;
            top: 50%;
            right: 0;
            height: 1px;
            background: #E8E8E8;
        }
        
        .divider span {
            background: white;
            padding: 0 1rem;
            position: relative;
            color: var(--text-light);
            font-size: 0.85rem;
        }
        
        .logo-container {
            text-align: center;
            margin-bottom: 2rem;
        }
        
        .logo-container i {
            font-size: 4rem;
            color: var(--accent-rose);
            background: white;
            width: 100px;
            height: 100px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 5px 20px rgba(248, 187, 217, 0.3);
        }
        
        .invalid-feedback {
            display: block;
            color: #dc3545;
            font-size: 0.875rem;
            margin-top: 0.25rem;
        }
        
        .form-control.is-invalid {
            border-color: #dc3545;
        }
        
        .btn-back-home {
            background: var(--soft-lavender);
            color: var(--text-dark);
            border: none;
            border-radius: 20px;
            padding: 0.5rem 1.5rem;
            text-decoration: none;
            transition: all 0.3s ease;
            font-weight: 500;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .btn-back-home:hover {
            background: var(--primary-pink);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(248, 187, 217, 0.3);
        }
    </style>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="auth-container">
        <div class="text-center mb-3">
            <a href="{{ url('/') }}" class="btn-back-home">
                <i class="bi bi-arrow-left"></i>Volver al Inicio
            </a>
        </div>
        
        <div class="logo-container">
            <i class="bi bi-flower1"></i>
        </div>
        
        <div class="auth-card">
            <div class="auth-header">
                <h2><i class="bi bi-flower1 me-2"></i>SPA & Masajes</h2>
                <p>Sistema de Gestión</p>
            </div>
            
            <div class="auth-body">
                @if ($errors->any())
                    <div class="alert alert-danger alert-spa">
                        <i class="bi bi-exclamation-triangle-fill me-2"></i>
                        <strong>Por favor corrige los siguientes errores:</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                {{ $slot }}
            </div>
        </div>
        
        <div class="text-center mt-4">
            <p class="text-muted mb-0">
                © {{ date('Y') }} SPA & Masajes. Todos los derechos reservados.
            </p>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
