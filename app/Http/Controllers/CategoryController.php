<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::all();

        return view('categories.index', ['categories' => $categories]);
    }

    public function create(): View
    {
        return view('categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'unique:categories,name', 'max:255'],
        ]);

        Category::query()->create([
            'name' => $validated['name'],
        ]);

        return redirect()->route('categories.index');
    }

    public function edit(int $id): View
    {
        $category = Category::query()->findOrFail($id);

        return view('categories.edit', ['category' => $category]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'unique:categories,name', 'max:255'],
        ]);

        Category::query()->findOrFail($id)->update([
            'name' => $validated['name'],
        ]);

        return redirect()->route('categories.index');
    }

    public function destroy(int $id): RedirectResponse
    {
        try {
            Category::query()->findOrFail($id)->delete();
            return redirect()->route('categories.index');
        } catch (QueryException $exception) {
            if ($exception->getCode() === '23000') {
                return redirect()->back()
                    ->withErrors(['msg' => 'Невозможно удалить категорию, так как она связана с продуктами.']);
            }
        }

        return redirect()->back()
            ->withErrors(['msg' => 'Произошла ошибка при удалении категории.']);
    }
}
