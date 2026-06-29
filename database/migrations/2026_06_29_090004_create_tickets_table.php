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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_number');
            $table->foreignId('user_id')->references('id')->on('users');
            $table->foreignId('assigned_to')->references('id')->on('users')->nullable();
            $table->foreignId('priority_id')->references('id')->on('priorities');
            $table->foreignId('status_id')->references('id')->on('statuses');
            $table->foreignId('category_id')->references('id')->on('categories');
            $table->string('subject');
            $table->text('description');
            $table->string('img')->nullable();
            $table->timestamp('closed_at')->nullable();
            $table->timestamp('resolved_at')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tickets');
    }
};
