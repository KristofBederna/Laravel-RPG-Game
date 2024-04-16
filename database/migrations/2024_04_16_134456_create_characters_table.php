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
        Schema::create('characters', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('enemy')->default(false);
            $table->integer('defence')->numberBetween(0, 3);
            $table->integer('strength')->numberBetween(0, 20);
            $table->integer('accuracy')->numberBetween(0, 20);
            $table->integer('magic')->numberBetween(0, 20);
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('characters');
    }
};
