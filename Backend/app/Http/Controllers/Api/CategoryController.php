<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function allCategories()
    {
        return response()->json(Category::all());
    }

    // Méthode pour récupérer les catégories de l'utilisateur connecté
    public function userCategories()
    {
        $user = auth()->user();
        return response()->json($user->categories);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category = auth()->user()->categories()->create($request->all());
        return response()->json($category, 201);
    }

    public function show(Category $category)
    {
        $this->authorize('view', $category);
        return response()->json($category);
    }

    public function update(Request $request, Category $category)
    {
        $this->authorize('update', $category);
        $category->update($request->all());
        return response()->json($category);
    }

    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);
        $category->delete();
        return response()->json(null, 204);
    }
}
