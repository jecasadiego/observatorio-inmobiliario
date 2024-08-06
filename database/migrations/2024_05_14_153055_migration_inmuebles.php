<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return  new  class  extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('inmuebles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_user')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_superadmin_observacion')->nullable()->constrained('users')->onDelete('set null');
            $table->string('nombre_inmueble');
            $table->string('destino_economico');
            $table->string('tipo_oferta');
            $table->string('tipo_inmueble');
            $table->string('direccion');
            $table->string('ciudad');
            $table->string('barrio');
            $table->decimal('latitud', 10, 7)->nullable();
            $table->decimal('longitud', 10, 7)->nullable();
            $table->text('descripcion');
            $table->integer('dias_restantes')->default(40);
            $table->string('estrato')->default(1);
            $table->integer('area_construida')->default(0);
            $table->integer('num_pisos')->default(0);
            $table->integer('num_habitaciones')->default(0);
            $table->integer('num_banos')->default(0);
            $table->integer('garajes')->default(0);
            $table->decimal('valor_arriendo_venta', 15, 2)->default(0);
            $table->decimal('valor_administracion', 15, 2)->default(0);
            $table->boolean('valor_incluye_administracion')->default(false);
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('celular');
            $table->string('correo');
            $table->boolean('contacto_whatsapp')->default(false);
            $table->boolean('politica_datos')->default(false);
            $table->text('observacion')->nullable();
            $table->timestamp('observacion_at')->nullable();
            $table->boolean('active')->default(true);
            $table->integer('estado')->default(1);
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
        Schema::dropIfExists('inmuebles');
    }
};
