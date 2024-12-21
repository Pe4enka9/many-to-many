<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(): View
    {
        $products = Product::all();

        return view('products.index', ['products' => $products]);
    }

    public function create(): View
    {
        $categories = Category::all();

        return view('products.create', ['categories' => $categories]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'unique:products,name', 'max:255'],
            'price' => ['required', 'numeric'],
            'categories' => ['required', 'array'],
        ]);

        $product = Product::query()->create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'slug' => Str::slug($validated['name']),
        ]);

        $product->categories()->sync($validated['categories']);

        return redirect()->route('products.index');
    }

    public function edit(int $id): View
    {
        $product = Product::query()->findOrFail($id);
        $categories = Category::all();

        return view('products.edit', ['product' => $product, 'categories' => $categories]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'max:255'],
            'price' => ['required', 'numeric'],
            'categories' => ['required', 'array'],
        ]);

        $product = Product::query()->findOrFail($id);
        $product::query()->update([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'slug' => Str::slug($validated['name']),
        ]);

        $product->categories()->sync($validated['categories']);

        return redirect()->route('products.index');
    }

    public function destroy(int $id): RedirectResponse
    {
        Product::query()->findOrFail($id)->delete();

        return redirect()->route('products.index');
    }
}
