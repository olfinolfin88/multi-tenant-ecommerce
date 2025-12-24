<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Inertia\Inertia;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Cache;

class ProductController extends Controller
{
    public function welcome()
    {
        // Save data products_list with cache 60 minutes
        $products = Cache::remember('products_frontpage', 60*60, function () {
            return Product::latest()->get();
        });

        return Inertia::render('Welcome', [
            'canLogin' => Route::has('login'),
            'canRegister' => Route::has('register'),
            'products' => $products, 
        ]);

    }

    public function index()
    {
        return Inertia::render('Dashboard', [
            'products'  => Product::latest()->get()
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
        ]);

        Product::create($validated);
        // Delete cache for data update
        Cache::forget('products_frontpage');

        return redirect()->route('dashboard');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();

        // Delete cache for data update
        Cache::forget('products_frontpage');
        return redirect()->back(); 
    }
}
