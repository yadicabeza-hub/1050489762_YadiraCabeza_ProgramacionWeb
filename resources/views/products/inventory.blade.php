@extends('layouts.admin')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-clipboard-data"></i> Control de Inventarios</h1>
    <p class="text-muted mb-0">Resumen completo del estado del inventario</p>
</div>

<!-- Tarjetas de Estadísticas -->
<div class="row g-4 mb-4">
    <div class="col-md-3">
        <div class="card-spa">
            <div class="card-body text-center p-4">
                <div class="mb-3">
                    <i class="bi bi-box-seam" style="font-size: 3rem; color: var(--accent-rose);"></i>
                </div>
                <h3 class="mb-1">{{ $totalProducts }}</h3>
                <p class="text-muted mb-0">Total de Productos</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card-spa">
            <div class="card-body text-center p-4">
                <div class="mb-3">
                    <i class="bi bi-stack" style="font-size: 3rem; color: var(--accent-rose);"></i>
                </div>
                <h3 class="mb-1">{{ number_format($totalStock) }}</h3>
                <p class="text-muted mb-0">Unidades en Stock</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card-spa">
            <div class="card-body text-center p-4">
                <div class="mb-3">
                    <i class="bi bi-exclamation-triangle" style="font-size: 3rem; color: #FFA500;"></i>
                </div>
                <h3 class="mb-1">{{ $lowStockProducts }}</h3>
                <p class="text-muted mb-0">Stock Bajo (≤10)</p>
            </div>
        </div>
    </div>
    
    <div class="col-md-3">
        <div class="card-spa">
            <div class="card-body text-center p-4">
                <div class="mb-3">
                    <i class="bi bi-x-circle" style="font-size: 3rem; color: #FF6B6B;"></i>
                </div>
                <h3 class="mb-1">{{ $outOfStockProducts }}</h3>
                <p class="text-muted mb-0">Sin Stock</p>
            </div>
        </div>
    </div>
</div>

<!-- Valor Total del Inventario -->
<div class="row g-4 mb-4">
    <div class="col-12">
        <div class="card-spa">
            <div class="card-header">
                <i class="bi bi-currency-dollar me-2"></i>Valor Total del Inventario
            </div>
            <div class="card-body text-center p-4">
                <h2 class="mb-0" style="color: var(--accent-rose); font-family: 'Playfair Display', serif;">
                    ${{ number_format($totalValue, 2) }}
                </h2>
                <p class="text-muted mb-0 mt-2">Valor calculado: Precio × Stock de todos los productos</p>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <!-- Productos con Stock Bajo -->
    <div class="col-md-6">
        <div class="card-spa">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-exclamation-triangle me-2"></i>Productos con Stock Bajo</span>
                <span class="badge bg-warning">{{ $lowStock->count() }}</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-spa table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Stock</th>
                                <th>Categoría</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($lowStock as $product)
                            <tr>
                                <td><strong>{{ $product->nombre }}</strong></td>
                                <td>
                                    <span class="badge bg-warning text-dark">
                                        {{ $product->stock }} unidades
                                    </span>
                                </td>
                                <td>
                                    @if($product->category)
                                        <span class="badge bg-light text-dark">
                                            <i class="bi bi-tag me-1"></i>{{ $product->category->nombre }}
                                        </span>
                                    @else
                                        <span class="text-muted">Sin categoría</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-outline-primary" title="Actualizar Stock">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">
                                    <i class="bi bi-check-circle" style="font-size: 2rem; color: #28a745;"></i>
                                    <p class="mt-2">¡Excelente! No hay productos con stock bajo</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Productos Sin Stock -->
    <div class="col-md-6">
        <div class="card-spa">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-x-circle me-2"></i>Productos Sin Stock</span>
                <span class="badge bg-danger">{{ $outOfStock->count() }}</span>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-spa table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Producto</th>
                                <th>Precio</th>
                                <th>Categoría</th>
                                <th>Acción</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($outOfStock as $product)
                            <tr>
                                <td><strong>{{ $product->nombre }}</strong></td>
                                <td>${{ number_format($product->precio, 2) }}</td>
                                <td>
                                    @if($product->category)
                                        <span class="badge bg-light text-dark">
                                            <i class="bi bi-tag me-1"></i>{{ $product->category->nombre }}
                                        </span>
                                    @else
                                        <span class="text-muted">Sin categoría</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-outline-danger" title="Reponer Stock">
                                        <i class="bi bi-plus-circle"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">
                                    <i class="bi bi-check-circle" style="font-size: 2rem; color: #28a745;"></i>
                                    <p class="mt-2">¡Perfecto! Todos los productos tienen stock</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Inventario por Categoría -->
<div class="row g-4 mt-4">
    <div class="col-12">
        <div class="card-spa">
            <div class="card-header">
                <i class="bi bi-tags me-2"></i>Inventario por Categoría
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-spa table-hover mb-0">
                        <thead>
                            <tr>
                                <th>Categoría</th>
                                <th>Total Productos</th>
                                <th>Unidades en Stock</th>
                                <th>Valor Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($inventoryByCategory as $category)
                            @php
                                $categoryStock = \App\Models\Product::where('category_id', $category->id)->sum('stock');
                                $categoryValue = \App\Models\Product::where('category_id', $category->id)
                                    ->selectRaw('SUM(precio * stock) as total')
                                    ->value('total') ?? 0;
                            @endphp
                            <tr>
                                <td>
                                    <strong>{{ $category->nombre }}</strong>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $category->products_count ?? 0 }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $categoryStock > 50 ? 'success' : ($categoryStock > 0 ? 'warning' : 'danger') }}">
                                        {{ number_format($categoryStock) }}
                                    </span>
                                </td>
                                <td>
                                    <strong>${{ number_format($categoryValue, 2) }}</strong>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox" style="font-size: 2rem;"></i>
                                    <p class="mt-2">No hay categorías registradas</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Productos con Buen Stock -->
<div class="row g-4 mt-4">
    <div class="col-12">
        <div class="card-spa">
            <div class="card-header d-flex justify-content-between align-items-center">
                <span><i class="bi bi-check-circle me-2"></i>Productos con Buen Stock (>10 unidades)</span>
                <a href="{{ route('products.index') }}" class="btn btn-light btn-sm">
                    <i class="bi bi-arrow-right me-1"></i>Ver Todos
                </a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-spa table-hover mb-0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Stock</th>
                                <th>Categoría</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($goodStock as $product)
                            <tr>
                                <td>{{ $product->id }}</td>
                                <td><strong>{{ $product->nombre }}</strong></td>
                                <td>${{ number_format($product->precio, 2) }}</td>
                                <td>
                                    <span class="badge bg-success">
                                        {{ $product->stock }} unidades
                                    </span>
                                </td>
                                <td>
                                    @if($product->category)
                                        <span class="badge bg-light text-dark">
                                            <i class="bi bi-tag me-1"></i>{{ $product->category->nombre }}
                                        </span>
                                    @else
                                        <span class="text-muted">Sin categoría</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm" role="group">
                                        <a href="{{ route('products.show', $product) }}" class="btn btn-sm btn-outline-primary" title="Ver">
                                            <i class="bi bi-eye"></i>
                                        </a>
                                        <a href="{{ route('products.edit', $product) }}" class="btn btn-sm btn-outline-secondary" title="Editar">
                                            <i class="bi bi-pencil"></i>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">
                                    <i class="bi bi-inbox" style="font-size: 2rem;"></i>
                                    <p class="mt-2">No hay productos con buen stock</p>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Acciones Rápidas -->
<div class="row g-4 mt-4">
    <div class="col-12">
        <div class="card-spa">
            <div class="card-header">
                <i class="bi bi-lightning-charge me-2"></i>Acciones Rápidas
            </div>
            <div class="card-body p-4">
                <div class="d-flex flex-wrap gap-3">
                    <a href="{{ route('products.create') }}" class="btn btn-spa-primary">
                        <i class="bi bi-plus-circle me-2"></i>Agregar Nuevo Producto
                    </a>
                    <a href="{{ route('products.index') }}" class="btn btn-spa-secondary">
                        <i class="bi bi-list-ul me-2"></i>Ver Todos los Productos
                    </a>
                    <a href="{{ route('categories.index') }}" class="btn btn-spa-secondary">
                        <i class="bi bi-tags me-2"></i>Gestionar Categorías
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
