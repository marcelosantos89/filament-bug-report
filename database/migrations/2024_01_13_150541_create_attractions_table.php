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
        Schema::create('attractions', function (Blueprint $table) {
            $table->id();

            $table->text('slug');

            $table->text('name');

            $table->text('description');

            $table->text('highlight_text');

            $table->text('chat_text')
                ->nullable();

            $table->foreignId('media_id')
                ->nullable()
                ->constrained()
                ->nullOnDelete();

            $table->longText('content')
                ->nullable();

            $table->string("recommended")
                ->nullable();

            $table->boolean('is_active');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('attractions');
    }
};
