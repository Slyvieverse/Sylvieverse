<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
   public function index(Request $request)
{
    $query = Product::where('status', 'active')
        ->whereHas('user', function ($q) {
            $q->where('role', 'admin'); // Only products created by admin users
        })
        ->with('category', 'user'); // Eager load category and user

    // Search filter
    if ($search = $request->input('search')) {
        $query->where(function ($q) use ($search) {
            $q->where('name', 'like', "%{$search}%")
              ->orWhere('description', 'like', "%{$search}%");
        });
    }

    // Category filter
    if ($category = $request->input('category')) {
        $query->where('category_id', $category);
    }

    $products = $query->paginate(12);
    $categories = Category::all();

    return view('catalog.index', compact('products', 'categories'));
}

    public function show(Product $product)
    {
        $product->load('category', 'reviews');
        // Fetch related products (same category, exclude current product, limit 3)
        $relatedProducts = Product::where('status', 'active')
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with('category')
            ->take(3)
            ->get();

        return view('catalog.show', compact('product', 'relatedProducts'));
    }
}
