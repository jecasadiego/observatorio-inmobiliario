<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imagenes_inmuebles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_inmueble')->constrained('inmuebles')->onDelete('cascade');
            $table->string('ruta_imagen');
            $table->boolean('portada')->default(0);
            $table->boolean('active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('imagenes_inmuebles');
    }
};
