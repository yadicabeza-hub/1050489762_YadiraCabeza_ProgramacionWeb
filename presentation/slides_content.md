# Presentación: Sistema de Gestión de Productos

---

# Título
- Proyecto: Gestión de Productos (Laravel)
- Autor: (tu nombre)
- Fecha: (fecha)

---

# Agenda
- Introducción y objetivo
- Stack y dependencias
- Arquitectura general
- Flujo CRUD (ejemplo: crear producto)
- Modelos y relaciones
- Validación y seguridad
- Demo breve (pasos)
- Limitaciones y mejoras
- Preguntas

---

# Introducción y objetivo
- Administra productos y categorías
- Interfaz administrativa con Blade
- Funcionalidades: listar, crear, ver, editar, eliminar

---

# Stack y dependencias
- PHP ^8.2
- Laravel ^12
- Dev: laravel/breeze (scaffolding auth), phpunit
- Archivo: composer.json

---

# Arquitectura general
- Browser -> Rutas (web.php) -> Middleware (auth) -> Controladores -> Modelos (Eloquent) -> Base de datos
- Vistas Blade renderizan la UI

---

# Rutas clave
- `GET /products` -> `ProductController@index`
- `GET /products/create` -> `ProductController@create`
- `POST /products` -> `ProductController@store`
- `GET /products/{product}` -> `ProductController@show`
- `GET /products/{product}/edit` -> `ProductController@edit`
- `PUT /products/{product}` -> `ProductController@update`
- `DELETE /products/{product}` -> `ProductController@destroy`

---

# Flujo: Crear producto (paso a paso)
1. Usuario autenticado abre `/products/create`
2. Formulario envía `POST /products` con CSRF
3. `ProductController@store` valida con `$request->validate(...)`
4. Si válida, `Product::create($validated)` persiste
5. Redirige a índice con mensaje `with('success', ... )`

---

# Modelos y Relaciones
- `Product`:
  - `fillable`: nombre, imagen, precio, stock, estado, category_id
  - `casts`: precio decimal:2, stock integer
  - `belongsTo` -> `Category`
- `Category`:
  - `fillable`: nombre, descripcion
  - `hasMany` -> `products`

---

# Migraciones y esquema
- `categories` (id, nombre, descripcion, timestamps)
- `products` (id, nombre, imagen, precio, stock, estado(enum), category_id nullable -> set null en delete, timestamps)

---

# Validación y seguridad
- Validación en controlador con reglas estrictas
- Formularios usan `@csrf` y `@method` cuando aplica
- Rutas protegidas con `auth` middleware
- Mass-assignment controlado por `$fillable`

---

# UI y Experiencia
- Listado con paginación (`paginate(10)`)
- Badges visuales para stock y estado
- Formularios con manejo de errores (`@error`) y `old()`

---

# Limitaciones actuales
- No hay manejo de subida/almacenamiento de `imagen` en controlador
- Validación repetida en `store` y `update` (se recomienda `FormRequest`)
- Faltan tests automáticos para el CRUD
- Falta control fino de autorizaciones (Policies)

---

# Mejoras recomendadas
- Implementar upload y almacenamiento con `Storage`
- Crear `ProductRequest` para validaciones
- Añadir tests Feature y Unit
- Añadir Policies para permisos
- Añadir API + Resources para frontend desacoplado

---

# Demo (comandos y pasos)
```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```
- Abrir `http://127.0.0.1:8000`, registrar usuario, navegar a `/products` y ejecutar CRUD

---

# Preguntas
- ¿Qué parte quieren ver en detalle?
- ¿Desean que incluya capturas o un video corto?

---

# Anexos: fragmentos de código
- `ProductController@index`:

```php
$products = Product::with('category')->latest()->paginate(10);
return view('products.index', compact('products'));
```

- Validación (`store` / `update`):
```php
$validated = $request->validate([
    'nombre' => 'required|string|max:255',
    'precio' => 'required|numeric|min:0',
    'stock' => 'required|integer|min:0',
    'estado' => 'required|in:activo,inactivo',
    'category_id' => 'nullable|exists:categories,id',
]);
```

---

# Contacto
- Indica si quieres que genere el `.pptx` automáticamente o solo la guía.
