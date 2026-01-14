<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->latest()->paginate(10);
        return view('products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'estado' => 'required|in:activo,inactivo',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        Product::create($validated);

        return redirect()->route('products.index')
            ->with('success', 'Producto creado exitosamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        $product->load('category');
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'precio' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'estado' => 'required|in:activo,inactivo',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $product->update($validated);

        return redirect()->route('products.index')
            ->with('success', 'Producto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')
            ->with('success', 'Producto eliminado exitosamente.');
    }

    /**
     * Display inventory overview with stock statistics.
     */
    public function inventory()
    {
        $totalProducts = Product::count();
        $totalStock = Product::sum('stock');
        $activeProducts = Product::where('estado', 'activo')->count();
        $lowStockProducts = Product::where('stock', '<=', 10)->where('stock', '>', 0)->count();
        $outOfStockProducts = Product::where('stock', '=', 0)->count();
        $totalValue = Product::selectRaw('SUM(precio * stock) as total')->value('total') ?? 0;

        // Productos con stock bajo (1-10 unidades)
        $lowStock = Product::where('stock', '<=', 10)
            ->where('stock', '>', 0)
            ->where('estado', 'activo')
            ->with('category')
            ->orderBy('stock', 'asc')
            ->get();

        // Productos sin stock
        $outOfStock = Product::where('stock', '=', 0)
            ->where('estado', 'activo')
            ->with('category')
            ->latest()
            ->get();

        // Productos con buen stock (>10 unidades)
        $goodStock = Product::where('stock', '>', 10)
            ->where('estado', 'activo')
            ->with('category')
            ->orderBy('stock', 'desc')
            ->take(10)
            ->get();

        // Inventario por categoría
        $inventoryByCategory = Category::withCount('products')->get();

        return view('products.inventory', compact(
            'totalProducts',
            'totalStock',
            'activeProducts',
            'lowStockProducts',
            'outOfStockProducts',
            'totalValue',
            'lowStock',
            'outOfStock',
            'goodStock',
            'inventoryByCategory'
        ));
    }
}
