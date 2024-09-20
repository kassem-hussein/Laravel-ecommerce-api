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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId("user")->constrained("users")->cascadeOnDelete();
            $table->foreignId("address")->constrained("addresses")->cascadeOnDelete();
            $table->decimal("subtotal");
            $table->decimal("tax")->nullable()->default(0);
            $table->decimal("shipping")->nullable()->default(0);
            $table->enum("status",["started","ready","in way","done"])->nullable()->default("started");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
