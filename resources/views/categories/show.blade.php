@extends('layouts.admin')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-eye"></i> Detalles de la Categoría</h1>
</div>

<div class="card-spa mb-3">
    <div class="card-header">
        <i class="bi bi-tags me-2"></i>{{ $category->nombre }}
    </div>
    <div class="card-body p-4">
        <div class="row mb-4">
            <div class="col-md-12 mb-3">
                <strong><i class="bi bi-tag me-2"></i>Nombre:</strong>
                <p class="ms-4">{{ $category->nombre }}</p>
            </div>
            <div class="col-md-12 mb-3">
                <strong><i class="bi bi-card-text me-2"></i>Descripción:</strong>
                <p class="ms-4">{{ $category->descripcion ?? 'Sin descripción' }}</p>
            </div>
            <div class="col-md-6 mb-3">
                <strong><i class="bi bi-box-seam me-2"></i>Total de Productos:</strong>
                <p class="ms-4">
                    <span class="badge bg-info">{{ $category->products->count() }} productos</span>
                </p>
            </div>
            <div class="col-md-6 mb-3">
                <strong><i class="bi bi-calendar me-2"></i>Fecha de Creación:</strong>
                <p class="ms-4">{{ $category->created_at->format('d/m/Y H:i') }}</p>
            </div>
        </div>
        
        @if($category->products->count() > 0)
        <hr>
        <h5 class="mb-3"><i class="bi bi-box-seam me-2"></i>Productos en esta categoría:</h5>
        <div class="table-responsive">
            <table class="table table-sm table-hover">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Estado</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($category->products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->nombre }}</td>
                        <td>${{ number_format($product->precio, 2) }}</td>
                        <td>{{ $product->stock }}</td>
                        <td>
                            <span class="badge badge-spa {{ $product->estado == 'activo' ? 'badge-active' : 'badge-inactive' }}">
                                {{ ucfirst($product->estado) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        @endif
    </div>
</div>

<div class="d-flex justify-content-end gap-2">
    <a href="{{ route('categories.index') }}" class="btn btn-spa-secondary">
        <i class="bi bi-arrow-left me-1"></i>Volver
    </a>
    <a href="{{ route('categories.edit', $category) }}" class="btn btn-spa-primary">
        <i class="bi bi-pencil me-1"></i>Editar
    </a>
</div>
@endsection

