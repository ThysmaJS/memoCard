<?php 
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Theme;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index($categoryId)
    {
        return Theme::where('category_id', $categoryId)->where('user_id', auth()->id())->get();
    }

    public function allThemesByCategory($categoryId)
    {
        // Récupérer tous les thèmes d'une catégorie sans filtrer par utilisateur
        return Theme::where('category_id', $categoryId)->with('user')->get();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id'
        ]);

        $theme = new Theme($request->all());
        $theme->user_id = auth()->id();
        $theme->save();

        return response()->json($theme, 201);
    }

    public function show(Theme $theme)
    {
        $this->authorize('view', $theme);
        return response()->json($theme);
    }

    public function update(Request $request, Theme $theme)
    {
        $this->authorize('update', $theme);
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id'
        ]);
        $theme->update($request->all());
        return response()->json($theme);
    }

    public function destroy(Theme $theme)
    {
        $this->authorize('delete', $theme);
        $theme->delete();
        return response()->json(null, 204);
    }

    public function allThemes()
    {
        $themes = Theme::where('user_id', auth()->id())->get();
        return response()->json($themes);
    }
    public function saveSettings(Request $request, $themeId)
{
    $validated = $request->validate([
        'levels' => 'required|integer|min:1',
        'newCardsPerDay' => 'required|integer|min:1'
    ]);

    $theme = Theme::find($themeId);
    $theme->levels = $validated['levels'];
    $theme->new_cards_per_day = $validated['newCardsPerDay'];
    $theme->save();

    return response()->json($theme);
}
}
