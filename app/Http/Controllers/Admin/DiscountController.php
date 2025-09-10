<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Models\Discount;
use App\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    public function index()
    {
        $discounts = Discount::with(['product', 'category'])->paginate(10);
        return view('admin.discounts.index', compact('discounts'));
    }

    public function create(Request $request)
    {
        $products = Product::all();
        $categories = Category::all();
        $product_id = $request->query('product_id');
        $category_id = $request->query('category_id');
        return view('admin.discounts.create', compact('products', 'categories', 'product_id', 'category_id'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_id' => 'nullable|exists:products,id',
            'category_id' => 'nullable|exists:categories,id',
            'percent_off' => 'nullable|numeric|min:0|max:100',
            'fixed_off' => 'nullable|numeric|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        if ($validated['percent_off'] && $validated['fixed_off']) {
            return back()->withErrors(['error' => 'Choose either percent off or fixed amount.']);
        }
        if ($validated['product_id'] && $validated['category_id']) {
            return back()->withErrors(['error' => 'Discount can apply to a product OR category.']);
        }
        if (!$validated['percent_off'] && !$validated['fixed_off']) {
            return back()->withErrors(['error' => 'Specify either percent off or fixed amount.']);
        }

        Discount::create($validated);
        return redirect()->route('admin.discounts.index')->with('success', 'Discount created.');
    }

    public function edit(Discount $discount)
    {
        $products = Product::all();
        $categories = Category::all();
        return view('admin.discounts.edit', compact('discount', 'products', 'categories'));
    }

    public function update(Request $request, Discount $discount)
    {
        $validated = $request->validate([
            'product_id' => 'nullable|exists:products,id',
            'category_id' => 'nullable|exists:categories,id',
            'percent_off' => 'nullable|numeric|min:0|max:100',
            'fixed_off' => 'nullable|numeric|min:0',
            'start_date' => 'nullable|date',
            'end_date' => 'nullable|date|after_or_equal:start_date',
        ]);

        if ($validated['percent_off'] && $validated['fixed_off']) {
            return back()->withErrors(['error' => 'Choose either percent off or fixed amount.']);
        }
        if ($validated['product_id'] && $validated['category_id']) {
            return back()->withErrors(['error' => 'Discount can apply to a product OR category.']);
        }
        if (!$validated['percent_off'] && !$validated['fixed_off']) {
            return back()->withErrors(['error' => 'Specify either percent off or fixed amount.']);
        }

        $discount->update($validated);
        return redirect()->route('admin.discounts.index')->with('success', 'Discount updated.');
    }

    public function destroy(Discount $discount)
    {
        $discount->delete();
        return redirect()->route('admin.discounts.index')->with('success', 'Discount deleted.');
    }
}
