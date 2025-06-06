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
        $options = [

       [

         'id' => 1,

         'name' => 'Tamaño Cuadrado Personalizado',

         'description' => 'Define las dimensiones exactas para tu diseño cuadrado (ej: 10x10m, 15x15m).',

         'is_active' => true,

       ],

       [

         'id' => 2,

         'name' => 'Servicio de Diseño Gráfico Profesional',

         'description' => 'Nuestro equipo de diseñadores creará una propuesta visual impactante para ti.',

         'is_active' => true,

       ],

       [

         'id' => 3,

         'name' => 'Definir Cantidad',

         'description' => 'Especifica el número de unidades que deseas producir o imprimir.',

         'is_active' => true,

       ],

       [

         'id' => 4,

         'name' => 'Mockup Digital Previo',

         'description' => 'Solicita una representación digital de cómo se verá tu producto final antes de la producción.',

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

         'description' => 'Indica el diámetro deseado para tus artículos de forma circular (ej: 8cm, 12cm).',

         'is_active' => true,

       ],

       [

         'id' => 7,

         'name' => 'Elegir Tamaño Predefinido',

         'description' => 'Selecciona entre una variedad de tamaños estándar populares para agilizar el proceso.',

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

         'description' => 'Indica si tu diseño requiere impresión en solo un lado o en ambos lados del material.',

         'is_active' => true,

       ],

       [

         'id' => 10,

         'name' => 'Detalles de la Solicitud',

         'description' => 'Proporciona cualquier instrucción adicional o especificación particular para tu pedido.',

         'is_active' => true,

       ],

       [

         'id' => 11,

         'name' => 'Revisión de Cotización',

         'description' => 'Opción para revisar y confirmar los detalles de la cotización antes de finalizar.',

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
