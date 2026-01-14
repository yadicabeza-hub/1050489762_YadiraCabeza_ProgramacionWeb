@extends('layouts.admin')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-speedometer2"></i> Dashboard</h1>
    <p class="text-muted mb-0">Bienvenido al panel de administración de SPA & Masajes</p>
</div>

<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card-spa">
            <div class="card-body text-center p-4">
                <div class="mb-3">
                    <i class="bi bi-box-seam" style="font-size: 3rem; color: var(--accent-rose);"></i>
                </div>
                <h3 class="mb-1">{{ \App\Models\Product::count() }}</h3>
                <p class="text-muted mb-0">Productos</p>
                <a href="{{ route('products.index') }}" class="btn btn-sm btn-spa-primary mt-2">
                    Ver todos <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card-spa">
            <div class="card-body text-center p-4">
                <div class="mb-3">
                    <i class="bi bi-tags" style="font-size: 3rem; color: var(--accent-rose);"></i>
                </div>
                <h3 class="mb-1">{{ \App\Models\Category::count() }}</h3>
                <p class="text-muted mb-0">Categorías</p>
                <a href="{{ route('categories.index') }}" class="btn btn-sm btn-spa-primary mt-2">
                    Ver todas <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card-spa">
            <div class="card-body text-center p-4">
                <div class="mb-3">
                    <i class="bi bi-people" style="font-size: 3rem; color: var(--accent-rose);"></i>
                </div>
                <h3 class="mb-1">{{ \App\Models\User::count() }}</h3>
                <p class="text-muted mb-0">Usuarios</p>
                <a href="{{ route('admin.users.index') }}" class="btn btn-sm btn-spa-primary mt-2">
                    Ver todos <i class="bi bi-arrow-right ms-1"></i>
                </a>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card-spa">
            <div class="card-body text-center p-4">
                <div class="mb-3">
                    <i class="bi bi-check-circle" style="font-size: 3rem; color: var(--accent-rose);"></i>
                </div>
                <h3 class="mb-1">{{ \App\Models\Product::where('estado', 'activo')->count() }}</h3>
                <p class="text-muted mb-0">Productos Activos</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card-spa">
            <div class="card-header">
                <i class="bi bi-box-seam me-2"></i>Últimos Productos
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Estado</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(\App\Models\Product::latest()->take(5)->get() as $product)
                            <tr>
                                <td>{{ $product->nombre }}</td>
                                <td>${{ number_format($product->precio, 2) }}</td>
                                <td>{{ $product->stock }}</td>
                                <td>
                                    <span class="badge badge-spa {{ $product->estado == 'activo' ? 'badge-active' : 'badge-inactive' }}">
                                        {{ ucfirst($product->estado) }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-3 text-muted">No hay productos</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <a href="{{ route('products.index') }}" class="btn btn-sm btn-spa-primary w-100">
                        Ver todos los productos
                    </a>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-md-6">
        <div class="card-spa">
            <div class="card-header">
                <i class="bi bi-tags me-2"></i>Categorías
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-sm table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Productos</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse(\App\Models\Category::withCount('products')->latest()->take(5)->get() as $category)
                            <tr>
                                <td>{{ $category->nombre }}</td>
                                <td>
                                    <span class="badge bg-info">{{ $category->products_count }}</span>
                                </td>
                                <td>
                                    <a href="{{ route('categories.show', $category) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="text-center py-3 text-muted">No hay categorías</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer bg-transparent border-0">
                    <a href="{{ route('categories.index') }}" class="btn btn-sm btn-spa-primary w-100">
                        Ver todas las categorías
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
