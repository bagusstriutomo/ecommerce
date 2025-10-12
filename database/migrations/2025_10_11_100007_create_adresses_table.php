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
        Schema::create('user_addresses', function (Blueprint $table) {
            $table->id(); // Sesuai dengan id int(11) auto_increment
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Foreign key ke tabel users
            $table->string('receiver_name', 100); // Sesuai dengan receiver_name varchar(100)
            $table->string('phone', 20)->nullable(); // Sesuai dengan phone varchar(20)
            $table->text('address_text'); // Sesuai dengan address_text text
            $table->string('city', 100)->nullable(); // Sesuai dengan city varchar(100)
            $table->string('postal_code', 20)->nullable(); // Sesuai dengan postal_code varchar(20)
            $table->timestamp('created_at')->useCurrent(); // Sesuai dengan created_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_addresses');
    }
};