<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('bling_id')->nullable();
            $table->foreignId('customer_id')->nullable()->constrained('bling_customers')->nullOnDelete();
            $table->string('number_request')->nullable()->index();
            $table->decimal('value_total', 10, 2)->default(0);
            $table->string('status')->nullable()->index();
            $table->dateTime('date_sell')->nullable();
            $table->integer('points_generated')->default(0);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
