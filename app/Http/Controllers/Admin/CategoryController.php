<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Automatically generate slug if not provided
        $validated['slug'] = Str::slug($validated['name']);

        // Ensure slug is unique
        $slugCount = Category::where('slug', $validated['slug'])->count();
        if ($slugCount > 0) {
            $validated['slug'] .= '-' . ($slugCount + 1);
        }

        // Create the new category
        Category::create($validated);

        // Redirect to the index with a success message
        return redirect()->route("admin.categories.index")->with('success', 'Category created successfully!');
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit(Category $category)
    {
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, Category $category)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        // Automatically generate slug if name changed
        if ($request->name !== $category->name) {
            $validated['slug'] = Str::slug($validated['name']);

            // Ensure slug is unique
            $slugCount = Category::where('slug', $validated['slug'])->where('id', '!=', $category->id)->count();
            if ($slugCount > 0) {
                $validated['slug'] .= '-' . ($slugCount + 1);
            }
        }

        // Update the category
        $category->update($validated);

        // Redirect to the index with a success message
        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        // Redirect to the index with a success message
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully!');
    }
}