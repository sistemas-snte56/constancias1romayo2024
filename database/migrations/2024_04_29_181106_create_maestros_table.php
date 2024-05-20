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
        Schema::create('maestros', function (Blueprint $table) {
            // $table->id();
            // $table->unsignedBigInteger('id_delegacion');
            // $table->string('nombre' , 250)->nullable();
            // $table->unsignedBigInteger('id_genero');
            // $table->string('apaterno' , 250);
            // $table->string('amaterno' , 250);
            // $table->string('rfc' , 250);
            // $table->string('npersonal' ,250);
            // $table->string('email' ,250);
            // $table->string('telefono' , 250);
            // $table->string('folio' , 250);
            // $table->string('codigo_id' , 250);
            // $table->string('codigo_qr')->nullable();
            // $table->timestamps();
            // $table->foreign('id_delegacion')->references('id')->on('delegacions');
            // $table->foreign('id_genero')->references('id')->on('generos');

            

            $table->id();
            $table->unsignedBigInteger('id_delegacion')->nullable();
            $table->string('nombre', 250)->nullable();
            $table->string('apaterno', 250)->nullable();
            $table->string('amaterno', 250)->nullable();
            $table->string('npersonal', 250)->nullable();
            $table->string('rfc', 250)->nullable();
            $table->unsignedBigInteger('id_genero')->nullable();
            $table->string('telefono', 250)->nullable();
            $table->string('email', 250)->nullable();
            $table->string('folio', 250)->nullable();
            $table->string('codigo_id', 250)->nullable();
            $table->string('codigo_qr')->nullable();
            $table->timestamps();

            $table->foreign('id_delegacion')->references('id')->on('delegacions')->onDelete('set null');
            $table->foreign('id_genero')->references('id')->on('generos')->onDelete('set null');




        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maestros');
    }
};
