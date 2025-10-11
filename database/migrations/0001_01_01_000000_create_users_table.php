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
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Sesuai dengan id int(11) auto_increment
            $table->string('name', 100); // Sesuai dengan name varchar(100)
            $table->string('email', 100)->unique(); // Sesuai dengan email varchar(100) unique
            $table->string('password_hash'); // Diubah dari 'password' menjadi 'password_hash' varchar(255)
            $table->enum('role', ['user', 'admin'])->default('user'); // Ditambahkan sesuai 'role' enum
            $table->string('phone_number', 20)->nullable(); // Ditambahkan sesuai 'phone_number' varchar(20) nullable
            $table->timestamps(); // Ini akan membuat created_at dan updated_at
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('email')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};