<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Card;
use Illuminate\Http\Request;

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
}
