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
        Schema::create('products', function (Blueprint $table) {
            $table->id(); // Sesuai dengan id int(11) auto_increment
            $table->string('name', 150); // Sesuai dengan name varchar(150)
            $table->text('description')->nullable(); // Sesuai dengan description text (nullable)
            $table->decimal('price', 12, 2); // Sesuai dengan price decimal(12,2)
            $table->integer('stock')->default(0); // Sesuai dengan stock int(11) default 0
            $table->foreignId('category_id')->nullable()->constrained()->onDelete('set null'); // Foreign key ke tabel categories
            $table->string('image_url')->nullable(); // Sesuai dengan image_url varchar(255) (nullable)
            $table->boolean('is_active')->default(true); // Sesuai dengan is_active tinyint(1) default 1 (true)
            $table->timestamps(); // Membuat created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};