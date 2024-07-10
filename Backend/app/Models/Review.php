<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Review extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'review_date',
        'max_level',
        'user_id',
        'theme_id',
        'level'
    ];

    // Relations
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function theme()
    {
        return $this->belongsTo(Theme::class);
    }

    // Met à jour la date de la prochaine révision en fonction du niveau
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

        $this->review_date = Carbon::now()->addDays($daysToAdd);
        $this->save();
    }

    // Met à jour le niveau et la date de révision
    public function updateLevel()
    {
        // Logique pour mettre à jour le niveau
        $this->level = min($this->level + 1, $this->max_level);
        $this->save();
    }
}
