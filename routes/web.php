<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\UserAdminController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome-spa');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    // Rutas de recursos
    Route::resource('products', ProductController::class);
    Route::resource('categories', CategoryController::class);
    
    // Vista de inventarios
    Route::get('/inventory', [ProductController::class, 'inventory'])->name('inventory.index');
    
    // Panel de administración de usuarios
    Route::get('/admin/users', [UserAdminController::class, 'index'])->name('admin.users.index');
});

require __DIR__.'/auth.php';
