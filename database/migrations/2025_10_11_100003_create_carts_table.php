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
        Schema::create('carts', function (Blueprint $table) {
            $table->id(); // Sesuai dengan id int(11) auto_increment
            $table->foreignId('user_id')->unique()->constrained()->onDelete('cascade'); // Foreign key ke tabel users
            $table->timestamp('created_at')->useCurrent(); // Sesuai dengan created_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
