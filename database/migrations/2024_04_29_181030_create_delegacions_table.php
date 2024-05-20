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
        Schema::create('delegacions', function (Blueprint $table) {

            $table->id();
            $table->unsignedBigInteger('id_region');
            $table->string('delegacion', 150);
            $table->string('sede', 150);
            $table->string('nivel', 150);
            $table->foreign('id_region')->references('id')->on('regions');
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('delegacions');
    }
};
