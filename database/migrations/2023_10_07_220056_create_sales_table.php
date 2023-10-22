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
        Schema::create('sales', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->timestamp('date');
            $table->integer('ammount');
            $table->integer('discount');
            $table->string('status');
            $table->uuid('costomer_id');
            $table->uuid('product_id');
            $table->timestamps();

            $table->foreign('costomer_id')->references('id')->on('costomers');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales');
    }
};
