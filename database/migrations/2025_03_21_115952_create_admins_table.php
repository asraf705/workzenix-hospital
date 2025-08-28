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
        Schema::create('admins', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->string('code')->nullable()->unique(); // Unique code, nullable
            $table->string('name'); // Admin's name
            $table->string('email')->unique(); // Unique email
            $table->string('phone')->nullable()->unique(); // Unique phone number, nullable
            $table->enum('role', ['admin', 'doctor', 'assistant','block'])->default('block'); // Role with default value
            $table->timestamp('email_verified_at')->nullable(); // Email verification timestamp
            $table->string('password'); // Password
            $table->rememberToken(); // Remember token for "remember me" functionality
            $table->timestamps(); // Created at and updated at timestamps
        });

        Schema::create('sessions_admin', function (Blueprint $table) {
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
        Schema::dropIfExists('admins'); // Drop the table if migration is rolled back
        Schema::dropIfExists('sessions_admin');
    }
};
