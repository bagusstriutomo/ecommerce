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
            $table->id(); // Sesuai dengan id int(11) auto_increment
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key ke tabel users
            $table->decimal('total', 12, 2); // Sesuai dengan total decimal(12,2)
            $table->enum('status', ['pending', 'diproses', 'dikirim', 'selesai', 'batal'])->default('pending'); // Sesuai dengan status enum
            $table->text('address_text'); // Sesuai dengan address_text text
            $table->string('payment_method', 50)->nullable()->default('COD'); // Sesuai dengan payment_method varchar(50)
            $table->string('shipping_method', 50)->nullable(); // Sesuai dengan shipping_method varchar(50)
            $table->decimal('shipping_cost', 12, 2)->nullable()->default(0); // Sesuai dengan shipping_cost decimal(12,2)
            $table->text('note')->nullable(); // Sesuai dengan note text
            $table->timestamps(); // Membuat created_at dan updated_at
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
