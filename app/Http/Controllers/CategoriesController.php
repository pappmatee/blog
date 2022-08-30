<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        $categories = Category::query()->select('id', 'parent_id', 'name')->get();

        return view('categories.index', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:255',
            'parent' => 'nullable',
        ]);

        $category = new Category();
        $category->name = $validated['name'];
        $category->parent_id = $validated['parent'] ?? null;
        $category->save();

        return redirect()->route('categories.index');
    }
}
