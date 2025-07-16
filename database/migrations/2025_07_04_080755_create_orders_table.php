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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('letter_number')->unique()->nullable();
            $table->foreignId('department_id')->nullable()->constrained('departments')->onDelete('set null');
            $table->foreignId('category_id')->nullable()->constrained('categories')->onDelete('set null');
            $table->foreignId('item_id')->nullable()->constrained('items')->onDelete('set null');
            $table->foreignId('pic')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('reporter')->nullable()->constrained('users')->onDelete('set null');
            $table->text('description')->nullable();
            $table->date('create_date')->nullable();
            $table->time('create_time')->nullable();
            $table->dateTime('started_at')->nullable();
            $table->dateTime('paused_at')->nullable();
            $table->dateTime('resume_at')->nullable();
            $table->integer('total_duration')->default(0);
            $table->foreignId('progress_id')->nullable()->constrained('progresses')->onDelete('set null');
            $table->foreignId('priority_id')->nullable()->constrained('priorities')->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
