<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Inmuebles;
use Illuminate\Support\Facades\DB;



class InmuebleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear 10 inmuebles de prueba para cada combinación de tipo_oferta y active
        for ($i = 0; $i < 10; $i++) {
            Inmuebles::create([
                'id_user' => 1, // Suponiendo que el usuario con ID 1 existe
                'nombre_inmueble' => 'Inmuebles de prueba ' . $i,
                'tipo_oferta' => Inmuebles::TIPO_OFERTA_VENTA,
                'tipo_inmueble' => Inmuebles::TIPO_INMUEBLE_APARTAMENTO,
                'direccion' => 'Calle ' . $i,
                'ciudad' => 'Ciudad ' . $i,
                'barrio' => 'Barrio ' . $i,
                'latitud' => rand(0, 90),
                'longitud' => rand(0, 180),
                'descripcion' => 'Descripción del inmueble de prueba ' . $i,
                'estrato' => 'Estrato ' . $i,
                'area_construida' => rand(50, 150),
                'num_pisos' => rand(1, 5),
                'num_habitaciones' => rand(1, 5),
                'num_banos' => rand(1, 3),
                'valor_arriendo_venta' => rand(10000000, 600000000),
                'valor_administracion' => rand(100000, 500000),
                'valor_incluye_administracion' => rand(0, 1),
                'nombres' => 'Nombre ' . $i,
                'apellidos' => 'Apellido ' . $i,
                'celular' => '123456789' . $i,
                'correo' => 'correo' . $i . '@ejemplo.com',
                'contacto_whatsapp' => rand(0, 1),
                'politica_datos' => true,
                'active' => 1,
            ]);

            Inmuebles::create([
                'id_user' => 1,
                'nombre_inmueble' => 'Inmuebles de prueba ' . ($i + 10),
                'tipo_oferta' => Inmuebles::TIPO_OFERTA_ARRIENDO,
                'tipo_inmueble' => Inmuebles::TIPO_INMUEBLE_CASA,
                'direccion' => 'Calle ' . ($i + 10),
                'ciudad' => 'Ciudad ' . ($i + 10),
                'barrio' => 'Barrio ' . ($i + 10),
                'latitud' => rand(0, 90),
                'longitud' => rand(0, 180),
                'descripcion' => 'Descripción del inmueble de prueba ' . ($i + 10),
                'estrato' => 'Estrato ' . ($i + 10),
                'area_construida' => rand(50, 150),
                'num_pisos' => rand(1, 5),
                'num_habitaciones' => rand(1, 5),
                'num_banos' => rand(1, 3),
                'valor_arriendo_venta' => rand(100000, 500000),
                'valor_administracion' => rand(10000, 50000),
                'valor_incluye_administracion' => rand(0, 1),
                'nombres' => 'Nombre ' . ($i + 10),
                'apellidos' => 'Apellido ' . ($i + 10),
                'celular' => '123456789' . ($i + 10),
                'correo' => 'correo' . ($i + 10) . '@ejemplo.com',
                'contacto_whatsapp' => rand(0, 1),
                'politica_datos' => true,
                'active' => 0,
            ]);
        }
    }
}
