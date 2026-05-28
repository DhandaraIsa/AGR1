<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description');
            $table->enum('type', ['curso', 'evento', 'congresso']);
            $table->string('image')->nullable();
            $table->dateTime('date')->nullable();
            $table->string('location')->nullable();
            $table->decimal('price', 10, 2)->default(0);
            $table->boolean('is_premium')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};
