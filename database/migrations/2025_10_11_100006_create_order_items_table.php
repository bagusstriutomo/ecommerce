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
        Schema::create('order_items', function (Blueprint $table) {
            $table->id(); // Sesuai dengan id int(11) auto_increment
            $table->foreignId('order_id')->constrained()->onDelete('cascade'); // Foreign key ke tabel orders
            $table->foreignId('product_id')->constrained()->onDelete('cascade'); // Foreign key ke tabel products
            $table->decimal('price', 12, 2); // Sesuai dengan price decimal(12,2)
            $table->unsignedInteger('qty'); // Sesuai dengan qty int(11)
            $table->decimal('subtotal', 12, 2); // Sesuai dengan subtotal decimal(12,2)
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};