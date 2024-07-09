<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Card extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'front',
        'back',
        'theme_id'
    ];

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }

    public function calculateNextReviewDate($level)
{
    $daysToAdd = 0;
    switch ($level) {
        case 1:
            $daysToAdd = 1;
            break;
        case 2:
            $daysToAdd = 3;
            break;
        case 3:
            $daysToAdd = 7;
            break;
        case 4:
            $daysToAdd = 14;
            break;
        case 5:
            $daysToAdd = 30;
            break;
    }

    $this->next_review_at = now()->addDays($daysToAdd);
    $this->save();
}

}

