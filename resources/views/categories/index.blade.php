@extends('layouts.admin')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-tags"></i> Gestión de Categorías</h1>
</div>

<div class="card-spa">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span><i class="bi bi-list-ul me-2"></i>Lista de Categorías</span>
        <a href="{{ route('categories.create') }}" class="btn btn-light btn-sm">
            <i class="bi bi-plus-circle me-1"></i>Nueva Categoría
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-spa table-hover mb-0">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Productos</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td><strong>{{ $category->nombre }}</strong></td>
                        <td>{{ $category->descripcion ?? 'Sin descripción' }}</td>
                        <td>
                            <span class="badge bg-info">
                                {{ $category->products_count }} productos
                            </span>
                        </td>
                        <td>
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('categories.show', $category) }}" class="btn btn-sm btn-outline-primary" title="Ver">
                                    <i class="bi bi-eye"></i>
                                </a>
                                <a href="{{ route('categories.edit', $category) }}" class="btn btn-sm btn-outline-secondary" title="Editar">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('¿Estás seguro de eliminar esta categoría?');">
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
                        <td colspan="5" class="text-center py-4 text-muted">
                            <i class="bi bi-inbox" style="font-size: 2rem;"></i>
                            <p class="mt-2">No hay categorías registradas</p>
                            <a href="{{ route('categories.create') }}" class="btn btn-spa-primary btn-sm mt-2">
                                <i class="bi bi-plus-circle me-1"></i>Crear Primera Categoría
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    @if($categories->hasPages())
    <div class="card-footer">
        {{ $categories->links() }}
    </div>
    @endif
</div>
@endsection

