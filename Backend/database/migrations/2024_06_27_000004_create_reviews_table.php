<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->date('review_date');
            $table->smallInteger('max_level');
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('theme_id')->constrained()->onDelete('cascade');
            $table->smallInteger('level');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down()
    {
        Schema::dropIfExists('reviews');
    }
}
