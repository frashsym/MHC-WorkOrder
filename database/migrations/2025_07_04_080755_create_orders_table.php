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
            $table->foreignId('department_id')->nullable()->constrained('departments')->onDelete('set null');
            $table->foreignId('category_id')->nullable()->constrained('categorys')->onDelete('set null');
            $table->foreignId('object_id')->nullable()->constrained('objects')->onDelete('set null');
            $table->foreignId('pic_id')->nullable()->constrained('pics')->onDelete('set null');
            $table->foreignId('reporter')->nullable()->constrained('users')->onDelete('set null');
            $table->string('title');
            $table->text('description')->nullable();
            $table->date('date')->nullable();
            $table->time('time')->nullable();
            $table->foreignId('progress_id')->nullable()->constrained('progress')->onDelete('set null');
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
