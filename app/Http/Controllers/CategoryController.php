<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{


    public function index()
    {
        $categories = Category::get();
        return response()->json($categories);
    }

    public function getCategories()
    {
        $categories = Category::get();
        return response()->json($categories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255'
        ]);

        $category = new Category();
        $category->title = $validated['title'];
        $category->description = $request->description ?? null;
        $category->save();
        return redirect()->route('dashboard')->with('success', 'Category added successfully.');
    }
}
