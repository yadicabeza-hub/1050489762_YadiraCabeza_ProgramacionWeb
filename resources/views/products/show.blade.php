@extends('layouts.admin')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-eye"></i> Detalles del Producto</h1>
</div>

    <div class="card-spa mb-3">
        <div class="card-header">
            <i class="bi bi-box-seam me-2"></i>{{ $product->nombre }}
        </div>
        <div class="card-body p-4">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <strong><i class="bi bi-tag me-2"></i>Nombre:</strong>
                    <p class="ms-4">{{ $product->nombre }}</p>
                </div>
            <div class="col-md-6 mb-3">
                <strong><i class="bi bi-currency-dollar me-2"></i>Precio:</strong>
                <p class="ms-4">${{ number_format($product->precio, 2) }}</p>
            </div>
            <div class="col-md-6 mb-3">
                <strong><i class="bi bi-box me-2"></i>Stock:</strong>
                <p class="ms-4">
                    <span class="badge bg-{{ $product->stock > 10 ? 'success' : ($product->stock > 0 ? 'warning' : 'danger') }}">
                        {{ $product->stock }} unidades
                    </span>
                </p>
            </div>
            <div class="col-md-6 mb-3">
                <strong><i class="bi bi-toggle-on me-2"></i>Estado:</strong>
                <p class="ms-4">
                    <span class="badge badge-spa {{ $product->estado == 'activo' ? 'badge-active' : 'badge-inactive' }}">
                        {{ ucfirst($product->estado) }}
                    </span>
                </p>
            </div>
            <div class="col-md-6 mb-3">
                <strong><i class="bi bi-tags me-2"></i>Categoría:</strong>
                <p class="ms-4">
                    @if($product->category)
                        <span class="badge bg-light text-dark">
                            {{ $product->category->nombre }}
                        </span>
                    @else
                        <span class="text-muted">Sin categoría</span>
                    @endif
                </p>
            </div>
            <div class="col-md-6 mb-3">
                <strong><i class="bi bi-calendar me-2"></i>Fecha de Creación:</strong>
                <p class="ms-4">{{ $product->created_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
    </div>
</div>

<div class="d-flex justify-content-end gap-2">
    <a href="{{ route('products.index') }}" class="btn btn-spa-secondary">
        <i class="bi bi-arrow-left me-1"></i>Volver
    </a>
    <a href="{{ route('products.edit', $product) }}" class="btn btn-spa-primary">
        <i class="bi bi-pencil me-1"></i>Editar
    </a>
</div>
@endsection

