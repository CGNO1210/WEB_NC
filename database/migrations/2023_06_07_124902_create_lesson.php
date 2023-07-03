<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lesson', function (Blueprint $table) {
            $table->id();
            $table->integer('cour_id');
            $table->integer('chapter_id');
            $table->string('lesson_name');
            $table->string('lesson_slug');
            $table->text('lesson_description');
            $table->string('lesson_video');
            //$table->foreign('chapter_id')->references('id')->on('chapter');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lesson');
    }
};
