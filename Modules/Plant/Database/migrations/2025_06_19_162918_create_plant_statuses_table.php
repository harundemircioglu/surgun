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
        Schema::create('plant_statuses', function (Blueprint $table) {
            $table->id();
            $table->foreignId('accesion_notebook_id')
                ->constrained('accesion_notebooks')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->date('observation_date')->nullable();
            $table->foreignId('garden_location_id')
                ->constrained('garden_locations')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            $table->enum('plant_status', [1, 2, 3, 4])->default(1)->nullable();
            $table->string('vegetation_status')->nullable();
            $table->text('observation')->nullable();
            $table->tinyInteger('status')->default(1)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('plant_statuses');
    }
};
