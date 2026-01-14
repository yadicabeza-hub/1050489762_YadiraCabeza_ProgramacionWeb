# Arquitectura MVC - Sistema de Inventarios

Este documento explica en detalle cómo está implementado el patrón MVC (Modelo-Vista-Controlador) en el sistema de inventarios.

## 📐 Patrón MVC

El patrón MVC separa la aplicación en tres componentes principales:

1. **Modelo (Model)**: Gestiona los datos y la lógica de negocio
2. **Vista (View)**: Presenta la información al usuario
3. **Controlador (Controller)**: Coordina entre el modelo y la vista

## 🗂️ Estructura del Proyecto

### 1. Modelo (Model)

**Ubicación**: `app/Models/Product.php`

El modelo `Product` extiende de `Illuminate\Database\Eloquent\Model` y representa la tabla `products` en la base de datos.

```php
class Product extends Model
{
    protected $fillable = [
        'nombre',
        'precio',
        'stock',      // Control de inventario
        'estado',
        'category_id',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'stock' => 'integer',  // Asegura que stock sea un entero
    ];

    // Relación con categoría
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
}
```

**Responsabilidades del Modelo**:
- Define la estructura de datos (fillable, casts)
- Gestiona relaciones con otros modelos
- Proporciona métodos para consultar la base de datos
- No contiene lógica de presentación ni de control

### 2. Vista (View)

**Ubicación**: `resources/views/products/`

Las vistas utilizan el motor de plantillas Blade de Laravel:

- `index.blade.php`: Lista todos los productos
- `create.blade.php`: Formulario para crear productos
- `edit.blade.php`: Formulario para editar productos
- `show.blade.php`: Muestra detalles de un producto

**Ejemplo de Vista (index.blade.php)**:
```blade
@extends('layouts.admin')

@section('content')
    <table>
        @foreach($products as $product)
            <tr>
                <td>{{ $product->nombre }}</td>
                <td>{{ $product->stock }}</td>  <!-- Control de stock -->
            </tr>
        @endforeach
    </table>
@endsection
```

**Responsabilidades de la Vista**:
- Presenta datos al usuario
- Recibe datos del controlador
- No contiene lógica de negocio
- No accede directamente a la base de datos

### 3. Controlador (Controller)

**Ubicación**: `app/Http/Controllers/ProductController.php`

El controlador maneja las peticiones HTTP y coordina entre el modelo y la vista.

**Métodos del Controlador**:

#### `index()` - Listar productos
```php
public function index()
{
    $products = Product::with('category')->latest()->paginate(10);
    return view('products.index', compact('products'));
}
```
**Flujo**: 
1. Recibe petición GET `/products`
2. Consulta el modelo para obtener productos
3. Pasa datos a la vista
4. Retorna la vista renderizada

#### `store()` - Crear producto
```php
public function store(Request $request)
{
    $validated = $request->validate([
        'stock' => 'required|integer|min:0',  // Validación de stock
    ]);
    
    Product::create($validated);
    return redirect()->route('products.index');
}
```
**Flujo**:
1. Recibe petición POST `/products`
2. Valida los datos (incluyendo stock)
3. Crea el producto usando el modelo
4. Redirige a la lista

#### `update()` - Actualizar producto
```php
public function update(Request $request, Product $product)
{
    $validated = $request->validate([
        'stock' => 'required|integer|min:0',  // Validación de stock
    ]);
    
    $product->update($validated);
    return redirect()->route('products.index');
}
```

#### `destroy()` - Eliminar producto
```php
public function destroy(Product $product)
{
    $product->delete();
    return redirect()->route('products.index');
}
```

**Responsabilidades del Controlador**:
- Recibe peticiones HTTP
- Valida datos de entrada
- Coordina con el modelo para operaciones de BD
- Pasa datos a la vista
- Retorna respuestas HTTP

## 🔄 Flujo Completo de una Operación

### Ejemplo: Crear un Producto

```
1. Usuario accede a /products/create
   ↓
2. Ruta (web.php) → ProductController@create
   ↓
3. Controlador consulta categorías del Modelo Category
   ↓
4. Controlador retorna vista 'products.create' con categorías
   ↓
5. Usuario completa formulario y envía POST /products
   ↓
6. Ruta → ProductController@store
   ↓
7. Controlador valida datos (incluyendo stock)
   ↓
8. Controlador usa Modelo Product::create()
   ↓
9. Modelo guarda en base de datos
   ↓
10. Controlador redirige a /products con mensaje de éxito
```

## 🛣️ Rutas (Routes)

**Ubicación**: `routes/web.php`

Las rutas conectan las URLs con los métodos del controlador:

```php
Route::resource('products', ProductController::class);
```

Esto genera automáticamente:
- `GET /products` → `index()`
- `GET /products/create` → `create()`
- `POST /products` → `store()`
- `GET /products/{id}` → `show()`
- `GET /products/{id}/edit` → `edit()`
- `PUT /products/{id}` → `update()`
- `DELETE /products/{id}` → `destroy()`

## 📊 Control de Stock

El control de stock está implementado en todas las capas:

### Base de Datos (Migración)
```php
$table->integer('stock')->default(0);
```

### Modelo
```php
protected $casts = [
    'stock' => 'integer',
];
```

### Controlador (Validación)
```php
'stock' => 'required|integer|min:0',
```

### Vista (Visualización)
```blade
<span class="badge bg-{{ $product->stock > 10 ? 'success' : 'warning' }}">
    {{ $product->stock }}
</span>
```

## ✅ Ventajas de la Arquitectura MVC

1. **Separación de Responsabilidades**: Cada componente tiene una función específica
2. **Mantenibilidad**: Fácil de modificar sin afectar otras partes
3. **Reutilización**: Los modelos pueden usarse en múltiples controladores
4. **Testabilidad**: Cada componente puede probarse independientemente
5. **Escalabilidad**: Fácil agregar nuevas funcionalidades

## 📝 Buenas Prácticas Implementadas

1. ✅ **Validación en el Controlador**: Todos los datos se validan antes de guardar
2. ✅ **Uso de Eloquent ORM**: Interacción con BD mediante el modelo
3. ✅ **Rutas RESTful**: Nombres y métodos HTTP estándar
4. ✅ **Vistas Blade**: Separación de lógica y presentación
5. ✅ **Mensajes de Feedback**: Confirmaciones de éxito/error
6. ✅ **Relaciones de Modelos**: Producto pertenece a Categoría

## 🔍 Verificación de la Arquitectura

Para verificar que el proyecto sigue MVC:

- ✅ **Modelo**: Solo contiene lógica de datos, no lógica de negocio compleja
- ✅ **Vista**: Solo muestra datos, no hace consultas directas a BD
- ✅ **Controlador**: Coordina modelo y vista, no contiene HTML
- ✅ **Rutas**: Solo definen mapeo URL → Controlador

---

**Conclusión**: El proyecto implementa correctamente el patrón MVC, separando claramente las responsabilidades entre Modelo, Vista y Controlador, facilitando el mantenimiento y la escalabilidad del sistema.
