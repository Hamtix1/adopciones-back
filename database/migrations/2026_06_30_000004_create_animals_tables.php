<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('animal_statuses', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('animals', function (Blueprint $table) {
            $table->id();
            $table->foreignId('shelter_id')->constrained()->cascadeOnDelete();
            $table->foreignId('animal_status_id')->constrained()->cascadeOnDelete();
            $table->string('name');
            $table->enum('species', ['dog', 'cat']);
            $table->enum('sex', ['male', 'female']);
            $table->string('age')->nullable();
            $table->string('size')->nullable();
            $table->string('weight')->nullable();
            $table->string('breed')->nullable();
            $table->string('color')->nullable();
            $table->date('rescue_date')->nullable();
            $table->string('rescue_location')->nullable();
            $table->text('story')->nullable();
            $table->boolean('sterilized')->default(false);
            $table->boolean('vaccinated')->default(false);
            $table->boolean('dewormed')->default(false);
            $table->boolean('microchipped')->default(false);
            $table->text('medical_conditions')->nullable();
            $table->text('disabilities')->nullable();
            $table->text('medications')->nullable();
            $table->text('medical_observations')->nullable();
            $table->boolean('available_for_adoption')->default(false);
            $table->boolean('available_for_sponsorship')->default(false);
            $table->boolean('adopted')->default(false);
            $table->boolean('in_recovery')->default(false);
            $table->boolean('deceased')->default(false);
            $table->boolean('lost')->default(false);
            $table->text('personality')->nullable();
            $table->boolean('lives_with_dogs')->default(false);
            $table->boolean('lives_with_cats')->default(false);
            $table->boolean('lives_with_children')->default(false);
            $table->string('video_url')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('animal_images', function (Blueprint $table) {
            $table->id();
            $table->foreignId('animal_id')->constrained()->cascadeOnDelete();
            $table->string('path');
            $table->string('alt_text')->nullable();
            $table->boolean('is_primary')->default(false);
            $table->timestamps();
        });

        Schema::create('animal_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('animal_id')->constrained()->cascadeOnDelete();
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->text('note');
            $table->string('type')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('animal_histories');
        Schema::dropIfExists('animal_images');
        Schema::dropIfExists('animals');
        Schema::dropIfExists('animal_statuses');
    }
};
