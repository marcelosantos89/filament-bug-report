<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('seo', function (Blueprint $table) {
            $table->id();

            $table->morphs('model');

            $table->longText('description')->nullable();
            $table->text('title')->nullable();

            $table->foreignId('media_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->text('author')->nullable();
            $table->text('robots')->nullable();
            $table->text('canonical_url')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('seo');
    }
};
