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
        Schema::create('entidad', function (Blueprint $table) {
            $table->id();
            $table->foreignId('id_divipos_municipios')->constrained('divipos_municipios')->onDelete('cascade');
            $table->text('url_entidad');
            $table->text('url_observatorio');
            $table->text('url_app');
            $table->text('remitente');
            $table->text('bcc');
            $table->text('email_noti_judiciales');
            $table->text('email_atencion_usuarios');
            $table->text('nombre');
            $table->text('nombre_oficina');
            $table->text('direccion');
            $table->text('barrio');
            $table->text('descripcion');
            $table->text('descripcion_horario');
            $table->text('imagen_logo');
            $table->text('ruta_logo');
            $table->text('imagen_header');
            $table->text('nombre_header');
            $table->text('imagen_footer');
            $table->text('nombre_footer');
            $table->tinyInteger('active')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('entidad');
    }
};
