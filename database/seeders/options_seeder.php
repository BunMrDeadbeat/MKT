<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class options_seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('options')->truncate();
        $options = [

       [

         'id' => 1,

         'name' => 'Tamaño Cuadrado Personalizado',

         'description' => 'Para definir las dimensiones exactas para un producto en metros cuadrados (ej: 10x10m, 15x15m).',

         'is_active' => true,

       ],

       [

         'id' => 2,

         'name' => 'Servicio de Diseño Gráfico Profesional',

         'description' => 'Para señalar si el usuario desea un diseño gráfico profesional para su producto.',

         'is_active' => true,

       ],

       [

         'id' => 3,

         'name' => 'Subir Diseño existente',

         'description' => 'Permite a los usuarios cargar un diseño que ya han creado previamente.',

         'is_active' => true,

       ],

       [

         'id' => 4,

         'name' => 'Definir Cantidad',

         'description' => 'Especifica el número de unidades que se desean producir o imprimir.',

         'is_active' => true,

       ],


       [

         'id' => 5,

         'name' => 'Selección de Formato',

         'description' => 'Elige el formato de archivo o las especificaciones de formato para tu proyecto.',

         'is_active' => true,

       ],

       [

         'id' => 6,

         'name' => 'Tamaño Circular Personalizado',

         'description' => 'Indica el diámetro deseado para los artículos de forma circular en centímetros (ej: 8cm, 12cm).',

         'is_active' => true,

       ],

       [

         'id' => 7,

         'name' => 'Elegir Tamaño Predefinido',

         'description' => 'Seleccionar entre una variedad de tamaños estándar.',

         'is_active' => true,

       ],

       [

         'id' => 8,

         'name' => 'Selección de Material',

         'description' => 'Escoge el tipo de material base para tu producto (ej: papel couché, vinilo, lona).',

         'is_active' => true,

       ],

       [

         'id' => 9,

         'name' => 'Impresión a una o dos caras',

         'description' => 'Indica si el diseño requiere impresión en solo un lado o en ambos lados del material.',

         'is_active' => true,

       ],

       [

         'id' => 10,

         'name' => 'Detalles de la Solicitud',

         'description' => 'Proporciona cualquier instrucción adicional o especificación particular para el pedido.',

         'is_active' => true,

       ],

       [

         'id' => 11,

         'name' => 'Pago Directo',

         'description' => 'Activar ésta opción si se desea activar pagos directos para el pedido y saltar el proceso de revisión y cotización.',

         'is_active' => true,

       ],

       [

         'id' => 12,

         'name' => 'Acabados Especiales',

         'description' => 'Añade detalles de acabado como laminado, barniz UV, o cortes especiales.',

         'is_active' => true,

       ],

     ];



     DB::table('options')->insert($options);
    }
}
