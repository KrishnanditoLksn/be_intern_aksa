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
        Schema::create('employees', function (Blueprint $table) {
            $table->uuid('id')->primary(true);
            $table->string('image')->nullable(true);
            $table->string('name')->nullable(true);
            $table->string('phone')->nullable(true);
            $table->string('position')->nullable(true);
            $table->uuid('division_id');
            $table->foreign('division_id')
                ->references('id')
                ->on('divisions')
                ->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
