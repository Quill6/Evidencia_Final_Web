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
        Schema::create('definiciones', function (Blueprint $table) {
            $table->id();
            $table->text('texto');
            $table->boolean('es_correcta')->default(false);
            $table->foreignId('palabra_id')->constrained();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('definiciones');
    }
};
