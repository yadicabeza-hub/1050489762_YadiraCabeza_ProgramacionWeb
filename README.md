# Sistema de Inventarios - Laravel

Sistema de gestión de inventarios desarrollado en Laravel que permite administrar productos con control de stock, implementando el patrón MVC (Modelo, Vista, Controlador) y operaciones CRUD completas.

## 📋 Características

- ✅ **Registro, edición y eliminación de productos**
- ✅ **Control de stock (cantidad disponible)**
- ✅ **Patrón MVC implementado**
- ✅ **Rutas RESTful para operaciones CRUD**
- ✅ **Controlador dedicado para gestión de productos**
- ✅ **Interfaz de usuario moderna y responsiva**
- ✅ **Validación de datos en formularios**
- ✅ **Gestión de categorías de productos**

## 🏗️ Arquitectura del Proyecto

El proyecto sigue una **arquitectura monolítica** con el patrón **MVC (Modelo-Vista-Controlador)**:

### Estructura de Directorios

```
├── app/
│   ├── Http/
│   │   └── Controllers/
│   │       └── ProductController.php    # Controlador principal de productos
│   └── Models/
│       └── Product.php                  # Modelo Eloquent para productos
├── database/
│   └── migrations/
│       └── *_create_products_table.php  # Migración de la tabla productos
├── resources/
│   └── views/
│       └── products/
│           ├── index.blade.php          # Lista de productos
│           ├── create.blade.php         # Formulario de creación
│           ├── edit.blade.php           # Formulario de edición
│           └── show.blade.php           # Vista de detalle
└── routes/
    └── web.php                          # Definición de rutas
```

## 🔄 Flujo MVC

1. **Rutas (routes/web.php)**: Define las URLs y asocia cada ruta a un método del controlador
2. **Controlador (ProductController)**: Procesa las peticiones HTTP, valida datos y coordina la lógica
3. **Modelo (Product)**: Interactúa con la base de datos mediante Eloquent ORM
4. **Vistas (Blade)**: Renderiza la interfaz de usuario con los datos proporcionados

## 🛣️ Rutas Implementadas

El sistema utiliza rutas de recursos (Resource Routes) que generan automáticamente todas las rutas CRUD:

| Método | Ruta | Acción | Descripción |
|--------|------|--------|-------------|
| GET | `/products` | `index()` | Lista todos los productos |
| GET | `/products/create` | `create()` | Muestra formulario de creación |
| POST | `/products` | `store()` | Guarda un nuevo producto |
| GET | `/products/{id}` | `show()` | Muestra detalles de un producto |
| GET | `/products/{id}/edit` | `edit()` | Muestra formulario de edición |
| PUT/PATCH | `/products/{id}` | `update()` | Actualiza un producto |
| DELETE | `/products/{id}` | `destroy()` | Elimina un producto |

## 📦 Modelo de Datos

### Tabla: `products`

| Campo | Tipo | Descripción |
|-------|------|-------------|
| `id` | bigint | Identificador único |
| `nombre` | string | Nombre del producto |
| `precio` | decimal(10,2) | Precio del producto |
| `stock` | integer | Cantidad disponible (control de inventario) |
| `estado` | enum | Estado: 'activo' o 'inactivo' |
| `category_id` | bigint | ID de la categoría (nullable) |
| `created_at` | timestamp | Fecha de creación |
| `updated_at` | timestamp | Fecha de actualización |

## 🎯 Funcionalidades del Controlador

### ProductController

El controlador `ProductController` implementa todos los métodos necesarios para el CRUD:

- **`index()`**: Lista productos con paginación (10 por página)
- **`create()`**: Muestra formulario de creación con categorías disponibles
- **`store()`**: Valida y guarda un nuevo producto
- **`show()`**: Muestra los detalles de un producto específico
- **`edit()`**: Muestra formulario de edición con datos actuales
- **`update()`**: Valida y actualiza un producto existente
- **`destroy()`**: Elimina un producto de la base de datos

### Validaciones Implementadas

- **Nombre**: Requerido, máximo 255 caracteres
- **Precio**: Requerido, numérico, mínimo 0
- **Stock**: Requerido, entero, mínimo 0 (control de inventario)
- **Estado**: Requerido, valores: 'activo' o 'inactivo'
- **Categoría**: Opcional, debe existir en la tabla categories

## 🚀 Instalación y Configuración

### Requisitos Previos

- PHP >= 8.2
- Composer
- Node.js y NPM
- Base de datos (MySQL, PostgreSQL o SQLite)

### Pasos de Instalación

1. **Clonar o descargar el proyecto**

2. **Instalar dependencias de PHP**
   ```bash
   composer install
   ```

3. **Instalar dependencias de Node.js**
   ```bash
   npm install
   ```

4. **Configurar el archivo de entorno**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

5. **Configurar la base de datos en `.env`**
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=inventarios
   DB_USERNAME=root
   DB_PASSWORD=
   ```

6. **Ejecutar migraciones**
   ```bash
   php artisan migrate
   ```

7. **Compilar assets (opcional para desarrollo)**
   ```bash
   npm run build
   # o para desarrollo con hot reload
   npm run dev
   ```

8. **Iniciar el servidor de desarrollo**
   ```bash
   php artisan serve
   ```

9. **Acceder a la aplicación**
   - URL: `http://localhost:8000`
   - Registrar un usuario o iniciar sesión
   - Navegar a `/products` para gestionar productos

## 📝 Uso del Sistema

### Crear un Producto

1. Acceder a `/products/create`
2. Completar el formulario:
   - Nombre del producto
   - Precio (decimal)
   - Stock (cantidad disponible)
   - Estado (activo/inactivo)
   - Categoría (opcional)
3. Hacer clic en "Guardar Producto"

### Editar un Producto

1. Desde la lista de productos, hacer clic en el botón de editar
2. Modificar los campos necesarios
3. Hacer clic en "Actualizar Producto"

### Eliminar un Producto

1. Desde la lista de productos, hacer clic en el botón de eliminar
2. Confirmar la eliminación

### Control de Stock

El sistema permite:
- Visualizar la cantidad disponible de cada producto
- Actualizar el stock mediante la edición del producto
- Ver indicadores visuales del nivel de stock (colores según cantidad)

## 🎨 Interfaz de Usuario

La interfaz incluye:
- Diseño moderno y responsivo
- Indicadores visuales de stock (verde: >10, amarillo: 1-10, rojo: 0)
- Badges de estado (activo/inactivo)
- Formularios con validación en tiempo real
- Mensajes de éxito/error
- Paginación en la lista de productos

## 🔒 Seguridad

- Autenticación requerida para acceder a las funcionalidades
- Validación de datos en el servidor
- Protección CSRF en todos los formularios
- Sanitización de inputs

## 📚 Tecnologías Utilizadas

- **Laravel 12**: Framework PHP
- **Eloquent ORM**: Para interacción con base de datos
- **Blade**: Motor de plantillas
- **Bootstrap 5**: Framework CSS
- **Bootstrap Icons**: Iconografía

## 📄 Licencia

Este proyecto es de código abierto y está disponible bajo la [Licencia MIT](https://opensource.org/licenses/MIT).

## 👨‍💻 Autor

Sistema de Inventarios desarrollado como proyecto educativo demostrando:
- Arquitectura MVC
- Operaciones CRUD
- Buenas prácticas de desarrollo
- Organización de código

---

**Nota**: Este proyecto es una implementación educativa de un sistema de inventarios básico. Para producción, se recomienda agregar funcionalidades adicionales como:
- Historial de movimientos de stock
- Alertas de stock bajo
- Reportes y estadísticas
- Exportación de datos
- API REST
- Tests automatizados
