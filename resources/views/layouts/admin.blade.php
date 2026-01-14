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
            background: linear-gradient(135deg, var(--cream) 0%, var(--secondary-pink) 100%);
            color: var(--text-dark);
        }
        
        .sidebar {
            background: linear-gradient(180deg, #FFFFFF 0%, var(--secondary-pink) 100%);
            min-height: 100vh;
            box-shadow: 2px 0 15px rgba(248, 187, 217, 0.2);
            position: fixed;
            width: 260px;
            z-index: 1000;
        }
        
        .sidebar-brand {
            padding: 2rem 1.5rem;
            border-bottom: 2px solid var(--primary-pink);
            background: linear-gradient(135deg, var(--primary-pink) 0%, var(--accent-rose) 100%);
            color: white;
            font-family: 'Playfair Display', serif;
            font-size: 1.5rem;
            font-weight: 700;
        }
        
        .sidebar-menu {
            padding: 1.5rem 0;
        }
        
        .sidebar-menu .nav-link {
            color: var(--text-dark);
            padding: 0.75rem 1.5rem;
            margin: 0.25rem 0.5rem;
            border-radius: 12px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }
        
        .sidebar-menu .nav-link:hover,
        .sidebar-menu .nav-link.active {
            background: linear-gradient(135deg, var(--primary-pink) 0%, var(--accent-rose) 100%);
            color: white;
            transform: translateX(5px);
        }
        
        .sidebar-menu .nav-link i {
            font-size: 1.2rem;
        }
        
        .main-content {
            margin-left: 260px;
            padding: 2rem;
            min-height: 100vh;
        }
        
        .page-header {
            background: white;
            padding: 1.5rem 2rem;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(248, 187, 217, 0.15);
            margin-bottom: 2rem;
        }
        
        .page-header h1 {
            font-family: 'Playfair Display', serif;
            color: var(--accent-rose);
            margin: 0;
            font-size: 2rem;
        }
        
        .card-spa {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(248, 187, 217, 0.15);
            border: none;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card-spa:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(248, 187, 217, 0.25);
        }
        
        .card-spa .card-header {
            background: linear-gradient(135deg, var(--primary-pink) 0%, var(--accent-rose) 100%);
            color: white;
            border: none;
            padding: 1.25rem;
            font-weight: 600;
        }
        
        .btn-spa-primary {
            background: linear-gradient(135deg, var(--primary-pink) 0%, var(--accent-rose) 100%);
            border: none;
            color: white;
            padding: 0.6rem 1.5rem;
            border-radius: 25px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .btn-spa-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(248, 187, 217, 0.4);
            color: white;
        }
        
        .btn-spa-secondary {
            background: var(--soft-lavender);
            border: none;
            color: var(--text-dark);
            padding: 0.6rem 1.5rem;
            border-radius: 25px;
            font-weight: 500;
        }
        
        .btn-spa-danger {
            background: linear-gradient(135deg, #FF6B6B 0%, #FF8787 100%);
            border: none;
            color: white;
            padding: 0.6rem 1.5rem;
            border-radius: 25px;
            font-weight: 500;
        }
        
        .table-spa {
            background: white;
            border-radius: 15px;
            overflow: hidden;
        }
        
        .table-spa thead {
            background: linear-gradient(135deg, var(--primary-pink) 0%, var(--accent-rose) 100%);
            color: white;
        }
        
        .table-spa tbody tr {
            transition: background 0.3s ease;
        }
        
        .table-spa tbody tr:hover {
            background: var(--secondary-pink);
        }
        
        .form-control:focus,
        .form-select:focus {
            border-color: var(--primary-pink);
            box-shadow: 0 0 0 0.2rem rgba(248, 187, 217, 0.25);
        }
        
        .badge-spa {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: 500;
        }
        
        .badge-active {
            background: linear-gradient(135deg, #A8E6CF 0%, #88D8A3 100%);
            color: #2D5016;
        }
        
        .badge-inactive {
            background: linear-gradient(135deg, #FFB3BA 0%, #FF9AA2 100%);
            color: #8B0000;
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
        
        .alert-warning {
            background: linear-gradient(135deg, #FFD4B3 0%, #FFC4A3 100%);
            color: #8B4513;
        }
        
        .alert-danger {
            background: linear-gradient(135deg, #FFB3BA 0%, #FF9AA2 100%);
            color: #8B0000;
        }
        
        @media (max-width: 768px) {
            .sidebar {
                transform: translateX(-100%);
                transition: transform 0.3s ease;
            }
            
            .sidebar.show {
                transform: translateX(0);
            }
            
            .main-content {
                margin-left: 0;
            }
        }
    </style>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    <div class="sidebar">
        <div class="sidebar-brand">
            <i class="bi bi-flower1"></i> SPA & Masajes
        </div>
        <nav class="sidebar-menu">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                        <i class="bi bi-house-door"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('products.*') ? 'active' : '' }}" href="{{ route('products.index') }}">
                        <i class="bi bi-box-seam"></i>
                        <span>Productos</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('inventory.*') ? 'active' : '' }}" href="{{ route('inventory.index') }}">
                        <i class="bi bi-clipboard-data"></i>
                        <span>Inventarios</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}" href="{{ route('categories.index') }}">
                        <i class="bi bi-tags"></i>
                        <span>Categorías</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}" href="{{ route('admin.users.index') }}">
                        <i class="bi bi-people"></i>
                        <span>Usuarios</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('profile.edit') }}">
                        <i class="bi bi-person-circle"></i>
                        <span>Perfil</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="nav-link w-100 text-start border-0 bg-transparent" style="cursor: pointer;">
                            <i class="bi bi-box-arrow-right"></i>
                            <span>Cerrar Sesión</span>
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
    </div>
    
    <div class="main-content">
        @if(session('success'))
            <div class="alert alert-success alert-spa alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle-fill me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        @if(session('error'))
            <div class="alert alert-danger alert-spa alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-circle-fill me-2"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        
        @yield('content')
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    @stack('scripts')
</body>
</html>

