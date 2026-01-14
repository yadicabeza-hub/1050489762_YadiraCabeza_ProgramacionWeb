@extends('layouts.admin')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-box-seam"></i> Gestión de Productos</h1>
</div>

<div class="card-spa">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-list-ul me-2"></i>Lista de Productos</span>
        <a href="{{ route('products.create') }}" class="btn btn-light btn-sm">
            <i class="bi bi-plus-circle me-1"></i>Nuevo Producto
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
                        <th>Estado</th>
                        <th>Categoría</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td><strong>{{ $product->nombre }}</strong></td>
                        <td>${{ number_format($product->precio, 2) }}</td>
                        <td>
                            <span class="badge bg-{{ $product->stock > 10 ? 'success' : ($product->stock > 0 ? 'warning' : 'danger') }}">
                                {{ $product->stock }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-spa {{ $product->estado == 'activo' ? 'badge-active' : 'badge-inactive' }}">
                                {{ ucfirst($product->estado) }}
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
                                <form action="{{ route('products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar este producto?');">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger" title="Eliminar">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">
                            <i class="bi bi-inbox" style="font-size: 2rem;"></i>
                            <p class="mt-2">No hay productos registrados</p>
                            <a href="{{ route('products.create') }}" class="btn btn-spa-primary btn-sm mt-2">
                                <i class="bi bi-plus-circle me-1"></i>Crear Primer Producto
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($products->hasPages())
    <div class="card-footer">
        {{ $products->links() }}
    </div>
    @endif
</div>
@endsection

