<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>SPA & Masajes - Bienvenida</title>
    
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
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, var(--cream) 0%, var(--secondary-pink) 50%, var(--soft-lavender) 100%);
            color: var(--text-dark);
            min-height: 100vh;
            overflow-x: hidden;
        }
        
        /* Decoraciones flotantes */
        .floating-decoration {
            position: absolute;
            opacity: 0.3;
            animation: float 6s ease-in-out infinite;
        }
        
        @keyframes float {
            0%, 100% {
                transform: translateY(0px) rotate(0deg);
            }
            50% {
                transform: translateY(-20px) rotate(5deg);
            }
        }
        
        .decoration-1 {
            top: 10%;
            left: 5%;
            font-size: 4rem;
            color: var(--primary-pink);
            animation-delay: 0s;
        }
        
        .decoration-2 {
            top: 20%;
            right: 8%;
            font-size: 3rem;
            color: var(--accent-rose);
            animation-delay: 1s;
        }
        
        .decoration-3 {
            bottom: 15%;
            left: 10%;
            font-size: 3.5rem;
            color: var(--soft-lavender);
            animation-delay: 2s;
        }
        
        .decoration-4 {
            bottom: 25%;
            right: 5%;
            font-size: 4rem;
            color: var(--warm-peach);
            animation-delay: 1.5s;
        }
        
        .decoration-5 {
            top: 50%;
            left: 2%;
            font-size: 2.5rem;
            color: var(--primary-pink);
            animation-delay: 0.5s;
        }
        
        .decoration-6 {
            top: 60%;
            right: 3%;
            font-size: 3rem;
            color: var(--accent-rose);
            animation-delay: 2.5s;
        }
        
        /* Header con botones */
        .header-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(248, 187, 217, 0.2);
            padding: 1rem 2rem;
        }
        
        .header-nav .nav-buttons {
            display: flex;
            gap: 1rem;
            justify-content: flex-end;
        }
        
        .btn-nav {
            padding: 0.6rem 1.5rem;
            border-radius: 25px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            border: 2px solid;
        }
        
        .btn-nav-login {
            background: transparent;
            color: var(--accent-rose);
            border-color: var(--accent-rose);
        }
        
        .btn-nav-login:hover {
            background: var(--accent-rose);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 107, 157, 0.3);
        }
        
        .btn-nav-register {
            background: linear-gradient(135deg, var(--primary-pink) 0%, var(--accent-rose) 100%);
            color: white;
            border-color: transparent;
        }
        
        .btn-nav-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(248, 187, 217, 0.4);
            color: white;
        }
        
        /* Contenido principal */
        .welcome-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 6rem 2rem 2rem;
            position: relative;
        }
        
        .welcome-card {
            background: white;
            border-radius: 30px;
            box-shadow: 0 20px 60px rgba(248, 187, 217, 0.3);
            padding: 4rem;
            max-width: 900px;
            width: 100%;
            position: relative;
            z-index: 10;
            animation: fadeInUp 0.8s ease;
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
        
        .welcome-title {
            font-family: 'Playfair Display', serif;
            font-size: 3.5rem;
            font-weight: 700;
            background: linear-gradient(135deg, var(--primary-pink) 0%, var(--accent-rose) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-align: center;
            margin-bottom: 1rem;
        }
        
        .welcome-subtitle {
            text-align: center;
            font-size: 1.3rem;
            color: var(--text-light);
            margin-bottom: 3rem;
        }
        
        .objective-section {
            margin-bottom: 3rem;
        }
        
        .section-title {
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: var(--accent-rose);
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }
        
        .section-title i {
            font-size: 1.8rem;
        }
        
        .objective-text {
            font-size: 1.1rem;
            line-height: 1.8;
            color: var(--text-dark);
            text-align: justify;
        }
        
        .contact-section {
            background: linear-gradient(135deg, var(--secondary-pink) 0%, var(--soft-lavender) 100%);
            border-radius: 20px;
            padding: 2.5rem;
            margin-top: 2rem;
        }
        
        .contact-info {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
        }
        
        .contact-item {
            display: flex;
            align-items: center;
            gap: 1rem;
            background: white;
            padding: 1.2rem;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(248, 187, 217, 0.15);
            transition: transform 0.3s ease;
        }
        
        .contact-item:hover {
            transform: translateY(-5px);
        }
        
        .contact-item i {
            font-size: 1.8rem;
            color: var(--accent-rose);
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--secondary-pink);
            border-radius: 50%;
        }
        
        .contact-item-content h5 {
            margin: 0;
            font-weight: 600;
            color: var(--text-dark);
            font-size: 0.95rem;
        }
        
        .contact-item-content p {
            margin: 0.3rem 0 0 0;
            color: var(--text-light);
            font-size: 0.9rem;
        }
        
        .decorative-line {
            height: 4px;
            background: linear-gradient(90deg, var(--primary-pink) 0%, var(--accent-rose) 50%, var(--soft-lavender) 100%);
            border-radius: 2px;
            margin: 2rem 0;
        }
        
        .alert-spa {
            border-radius: 15px;
            border: none;
            padding: 1rem 1.5rem;
        }
        
        .alert-success {
            background: linear-gradient(135deg, #A8E6CF 0%, #88D8A3 100%);
            color: #2D5016;
        }
        
        @media (max-width: 768px) {
            .welcome-title {
                font-size: 2.5rem;
            }
            
            .welcome-card {
                padding: 2.5rem 1.5rem;
            }
            
            .header-nav {
                padding: 1rem;
            }
            
            .header-nav .nav-buttons {
                flex-direction: column;
                gap: 0.5rem;
            }
            
            .btn-nav {
                width: 100%;
                text-align: center;
            }
        }
    </style>
</head>
<body>
    <!-- Header con botones de navegación -->
    <header class="header-nav">
        <div class="container-fluid">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <a href="{{ url('/') }}" style="text-decoration: none;">
                        <h4 class="mb-0" style="font-family: 'Playfair Display', serif; color: var(--accent-rose); transition: all 0.3s ease;">
                            <i class="bi bi-flower1"></i> SPA & Masajes
                        </h4>
                    </a>
                </div>
                <div class="nav-buttons">
                    <a href="{{ route('login') }}" class="btn btn-nav btn-nav-login">
                        <i class="bi bi-box-arrow-in-right me-1"></i>Iniciar Sesión
                    </a>
                    <a href="{{ route('register') }}" class="btn btn-nav btn-nav-register">
                        <i class="bi bi-person-plus me-1"></i>Registrarse
                    </a>
                </div>
            </div>
        </div>
    </header>
    
    <!-- Decoraciones flotantes -->
    <div class="floating-decoration decoration-1">
        <i class="bi bi-flower1"></i>
    </div>
    <div class="floating-decoration decoration-2">
        <i class="bi bi-flower2"></i>
    </div>
    <div class="floating-decoration decoration-3">
        <i class="bi bi-flower3"></i>
    </div>
    <div class="floating-decoration decoration-4">
        <i class="bi bi-heart"></i>
    </div>
    <div class="floating-decoration decoration-5">
        <i class="bi bi-stars"></i>
    </div>
    <div class="floating-decoration decoration-6">
        <i class="bi bi-heart-fill"></i>
    </div>
    
    <!-- Contenido principal -->
    <div class="welcome-container">
        @if(session('status'))
            <div class="alert alert-success alert-spa mb-4" style="max-width: 900px; width: 100%; margin: 0 auto 2rem;">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('status') }}
            </div>
        @endif
        
        <div class="welcome-card">
            <h1 class="welcome-title">
                <i class="bi bi-flower1"></i> Bienvenida
            </h1>
            <p class="welcome-subtitle">
                Tu espacio de relajación y bienestar
            </p>
            
            <div class="decorative-line"></div>
            
            <div class="objective-section">
                <h2 class="section-title">
                    <i class="bi bi-bullseye"></i>
                    Nuestro Objetivo
                </h2>
                <div class="objective-text">
                    <p>
                        En <strong>SPA & Masajes</strong>, nos dedicamos a brindarte una experiencia única de relajación, 
                        bienestar y cuidado personal. Nuestro objetivo es proporcionar servicios de alta calidad que 
                        te ayuden a desconectar del estrés diario y reconectar contigo misma.
                    </p>
                    <p class="mt-3">
                        Ofrecemos un ambiente tranquilo y acogedor donde podrás disfrutar de tratamientos especializados 
                        diseñados para rejuvenecer tu cuerpo y mente. Cada sesión está pensada para que te sientas renovada, 
                        relajada y llena de energía positiva.
                    </p>
                    <p class="mt-3">
                        Nuestro sistema de gestión te permite administrar productos, categorías y usuarios de manera 
                        eficiente, facilitando la operación diaria de nuestro centro de bienestar.
                    </p>
                </div>
            </div>
            
            <div class="decorative-line"></div>
            
            <div class="contact-section">
                <h2 class="section-title" style="color: var(--text-dark);">
                    <i class="bi bi-telephone-forward"></i>
                    Contáctanos
                </h2>
                <div class="contact-info">
                    <div class="contact-item">
                        <i class="bi bi-person-circle"></i>
                        <div class="contact-item-content">
                            <h5>Responsable</h5>
                            <p>Yadira Cabeza</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="bi bi-telephone"></i>
                        <div class="contact-item-content">
                            <h5>Teléfono</h5>
                            <p>0988631348</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="bi bi-envelope"></i>
                        <div class="contact-item-content">
                            <h5>Email</h5>
                            <p>yadicabeza96@gmail.com</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <i class="bi bi-geo-alt"></i>
                        <div class="contact-item-content">
                            <h5>Ubicación</h5>
                            <p>San Lorenzo - Esmeraldas</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

