<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('seed_banks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('accesion_notebook_id')
                ->constrained('accesion_notebooks')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->json('quantity')->nullable();
            $table->foreignId('seed_cabinet_id')
                ->constrained('seed_cabinets')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->tinyInteger('status')->default(1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seed_banks');
    }
};
