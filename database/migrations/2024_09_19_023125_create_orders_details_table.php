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
        Schema::create('orders_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId("order")->constrained("orders")->cascadeOnDelete();
            $table->foreignId("product")->constrained("products")->cascadeOnDelete();
            $table->integer("quantity");
            $table->foreignId("size")->nullable()->constrained("sizes")->nullOnDelete();
            $table->foreignId("color")->nullable()->constrained("colors")->nullOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders_details');
    }
};
