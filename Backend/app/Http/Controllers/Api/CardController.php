<?php

namespace App\Http\Controllers\Api;

use App\Models\Card;
use App\Models\Theme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CardController extends Controller
{
    public function index($themeId)
    {
        return Card::where('theme_id', $themeId)->get();
    }

    public function storeBatch(Request $request)
    {
        $request->validate([
            'cards' => 'required|array',
            'cards.*.front' => 'required|string',
            'cards.*.back' => 'required|string',
            'cards.*.theme_id' => 'required|exists:themes,id'
        ]);
    
        $cards = [];
        foreach ($request->cards as $cardData) {
            $cards[] = Card::create($cardData);
        }
    
        return response()->json($cards, 201);
    }
    public function show(Card $card)
    {
        $this->authorize('view', $card);
        return response()->json($card);
    }

    public function update(Request $request, Card $card)
    {
        $this->authorize('update', $card);
        $card->update($request->all());
        return response()->json($card);
    }

    public function destroy(Card $card)
    {
        $this->authorize('delete', $card);
        $card->delete();
        return response()->json(null, 204);
    }
    public function dailyReview($themeId)
{
    $theme = Theme::find($themeId);
    $newCards = Card::where('theme_id', $themeId)
                    ->whereNull('last_reviewed_at')
                    ->take($theme->new_cards_per_day)
                    ->get();

    $reviewCards = Card::where('theme_id', $themeId)
                       ->whereNotNull('last_reviewed_at')
                       ->orderBy('next_review_at')
                       ->take($theme->new_cards_per_day)
                       ->get();

    return response()->json([
        'newCards' => $newCards,
        'reviewCards' => $reviewCards
    ]);
}

}
