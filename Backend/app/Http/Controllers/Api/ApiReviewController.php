<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ApiReviewController extends Controller
{
    public function userReviews()
    {
        $userId = auth()->id();
        if (!$userId) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }
        $reviews = Review::where('user_id', $userId)->with('theme')->get();
        return response()->json($reviews);
    }

    public function store(Request $request)
    {
        $this->authorize('create', Review::class);

        try {
            $validated = $request->validate([
                'review_date' => 'required|date',
                'max_level' => 'required|integer',
                'user_id' => 'required|exists:users,id',
                'theme_id' => 'required|exists:themes,id',
                'level' => 'required|integer'
            ]);

            $review = Review::create($validated);

            return response()->json(['message' => 'Review started successfully', 'review' => $review]);
        } catch (\Exception $e) {
            Log::error('Erreur lors de la création de la révision: ' . $e->getMessage());
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    public function finishReview(Request $request)
    {
        $themeId = $request->input('theme_id');
        $userId = $request->input('user_id');

        $review = Review::where('theme_id', $themeId)
                        ->where('user_id', $userId)
                        ->orderBy('review_date', 'desc')
                        ->first();

        if ($review) {
            $this->authorize('update', $review);
        } else {
            abort(404, 'Review not found');
        }

        try {
            $review->updateLevel();
            $review->calculateNextReviewDate($review->level);

            Log::info('Review finished successfully');
            
            return response()->json(['message' => 'Review finished successfully.']);
        } catch (\Exception $e) {
            Log::error('Error in finishReview: ' . $e->getMessage());
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    public function resetReviewLevel(Request $request)
    {
        $themeId = $request->input('theme_id');
        $userId = $request->input('user_id');
    
        $review = Review::where('theme_id', $themeId)
                        ->where('user_id', $userId)
                        ->orderBy('review_date', 'desc')
                        ->first();
    
        if ($review) {
            $this->authorize('update', $review);
        } else {
            abort(404, 'Review not found');
        }
    
        try {
            $review->level = 1;
            $review->calculateNextReviewDate($review->level);
            $review->save();
    
            Log::info('Review level reset to 1 successfully');
            
            return response()->json(['message' => 'Review level reset to 1 successfully.']);
        } catch (\Exception $e) {
            Log::error('Error in resetReviewLevel: ' . $e->getMessage());
            return response()->json(['message' => 'Internal Server Error'], 500);
        }
    }

    public function checkReview(Request $request)
    {
        $themeId = $request->input('theme_id');
        $userId = $request->input('user_id');
        
        $review = Review::where('theme_id', $themeId)
                        ->where('user_id', $userId)
                        ->first();

        if ($review) {
            return response()->json(['review' => $review]);
        } else {
            return response()->json(['review' => null]);
        }
    }
}
