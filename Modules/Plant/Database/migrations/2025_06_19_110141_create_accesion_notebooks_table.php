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
        Schema::create('accesion_notebooks', function (Blueprint $table) {
            $table->id();
            $table->string('accesion_number')->nullable()->unique();
            $table->string('plant_name')->nullable();
            $table->foreignId('plant_material_id')
                ->constrained('plant_materials')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->foreignId('plant_origin_id')
                ->constrained('plant_origins')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->string('location')->nullable();
            $table->string('coordinate')->nullable();
            $table->date('convening_date')->nullable();
            $table->foreignId('user_id')
                ->comment('collector user')
                ->constrained('users')
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
        Schema::dropIfExists('accesion_notebooks');
    }
};
