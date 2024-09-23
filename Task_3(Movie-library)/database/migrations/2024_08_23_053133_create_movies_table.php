<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * table for movies
     */
   public function up(): void
{
    Schema::create('movies', function (Blueprint $table) {
        $table->id();
        $table->text('title'); 
        $table->text('director');
        $table->text('genre');
        $table->integer('release_year');
        $table->text('description');
        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('movies');
    }
};
