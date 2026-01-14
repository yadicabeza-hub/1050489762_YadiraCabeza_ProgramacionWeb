@extends('layouts.admin')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-plus-circle"></i> Crear Nueva Categoría</h1>
</div>

<div class="card-spa">
    <div class="card-header">
        <i class="bi bi-tags me-2"></i>Información de la Categoría
    </div>
    <div class="card-body p-4">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre de la Categoría <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('nombre') is-invalid @enderror" 
                       id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                @error('nombre')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control @error('descripcion') is-invalid @enderror" 
                          id="descripcion" name="descripcion" rows="4">{{ old('descripcion') }}</textarea>
                @error('descripcion')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            
            <div class="d-flex justify-content-end gap-2 mt-4">
                <a href="{{ route('categories.index') }}" class="btn btn-spa-secondary">
                    <i class="bi bi-x-circle me-1"></i>Cancelar
                </a>
                <button type="submit" class="btn btn-spa-primary">
                    <i class="bi bi-check-circle me-1"></i>Guardar Categoría
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

