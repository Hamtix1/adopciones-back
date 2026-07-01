<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('shelters', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->string('name');
            $table->string('logo_path')->nullable();
            $table->string('cover_image_path')->nullable();
            $table->text('description')->nullable();
            $table->text('mission')->nullable();
            $table->foreignId('municipality_id')->constrained()->cascadeOnDelete();
            $table->string('address')->nullable();
            $table->string('neighborhood')->nullable();
            $table->string('phone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('email')->nullable();
            $table->string('facebook')->nullable();
            $table->string('instagram')->nullable();
            $table->string('responsible_person')->nullable();
            $table->enum('status', ['pending', 'approved', 'blocked', 'inactive'])->default('pending');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('shelters');
    }
};
