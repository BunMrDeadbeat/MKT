<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::pluck('id', 'name')->all();
        if (empty($categories)) {
            $this->command->error('No se encontraron categorías. Por favor, ejecuta CategoriesSeeder primero.');
            return;
        }

        $products = [
            // Categoria: publicidad -> type: product
            ['name' => 'Volantes y Folletos', 'description' => 'Impresión de volantes y folletos en alta calidad, perfectos para campañas publicitarias y eventos.', 'category' => 'publicidad', 'type' => 'product'],
            ['name' => 'Tarjetas de Presentación', 'description' => 'Diseño e impresión de tarjetas de presentación con acabados profesionales para causar una gran impresión.', 'category' => 'publicidad', 'type' => 'product'],
            ['name' => 'Impresión de Lonas', 'description' => 'Lonas publicitarias y para eventos, impresas en alta resolución y materiales resistentes.', 'category' => 'publicidad', 'type' => 'product'],
            ['name' => 'Vinilos Adhesivos', 'description' => 'Vinilos para decoración de interiores, rotulación de vehículos y señalización.', 'category' => 'publicidad', 'type' => 'product'],
            ['name' => 'Impresión DTF (Direct to Film)', 'description' => 'Personalización de playeras y textiles con alta durabilidad y colores vibrantes.', 'category' => 'publicidad', 'type' => 'product'],
            ['name' => 'Tazas Sublimadas', 'description' => 'Tazas personalizadas con tus fotos, logos o diseños favoritos mediante la técnica de sublimación. Ideal para regalos y uso corporativo.', 'category' => 'publicidad', 'type' => 'product'],
            ['name' => 'Termos Personalizados', 'description' => 'Mantén tus bebidas a la temperatura ideal con nuestros termos personalizados. Perfectos como artículo promocional o para uso personal.', 'category' => 'publicidad', 'type' => 'product'],
            ['name' => 'Llaveros Sublimados', 'description' => 'Llaveros personalizados con imágenes de alta calidad. Un excelente y económico artículo promocional.', 'category' => 'publicidad', 'type' => 'product'],
            ['name' => 'Anuncios 3D', 'description' => 'Anuncios con letras y logotipos en 3D para fachadas e interiores, fabricados en diversos materiales.', 'category' => 'publicidad', 'type' => 'product'],
            ['name' => 'Vinil Microperforado', 'description' => 'Vinil para ventanas que permite la visibilidad desde el interior mientras muestra publicidad en el exterior.', 'category' => 'publicidad', 'type' => 'product'],
            ['name' => 'Vinil de Corte', 'description' => 'Rotulación con vinil de colores sólidos, ideal para logotipos, textos y gráficos en superficies lisas.', 'category' => 'publicidad', 'type' => 'product'],
            ['name' => 'Etiquetas en Rollo', 'description' => 'Impresión de etiquetas adhesivas en rollo para productos, empaques y aplicaciones industriales.', 'category' => 'publicidad', 'type' => 'product'],

            // Categoria: servicios -> type: service
            ['name' => 'Desarrollo Web a la Medida', 'description' => 'Creación de Sitios WEB con dominio propio y alojados en servidores en la nube.', 'category' => 'servicios', 'type' => 'service'],
            ['name' => 'Landing Pages', 'description' => 'Creación de Sitios WEB de Aterrizaje especializados en la captación de LEADS en los Funnels de ventas.', 'category' => 'servicios', 'type' => 'service'],
            ['name' => 'Tiendas en Línea (E-commerce)', 'description' => 'Desarrollamos tu tienda en línea completa, con carrito de compras, pasarelas de pago y gestión de productos.', 'category' => 'servicios', 'type' => 'service'],
            ['name' => 'Software para Punto de Venta', 'description' => 'Soluciones de software para gestionar ventas, inventario y reportes en tu negocio físico.', 'category' => 'servicios', 'type' => 'service'],

            // Categoria: cursos -> type: service
            ['name' => 'Curso de Ventas', 'description' => 'Desarrolla habilidades de negociación y cierre de ventas para potenciar tus resultados comerciales.', 'category' => 'cursos', 'type' => 'service'],
            ['name' => 'Curso de Servicio al Cliente', 'description' => 'Aprende a ofrecer una atención excepcional y a fidelizar a tus clientes a través de un servicio de calidad.', 'category' => 'cursos', 'type' => 'service'],
            ['name' => 'Curso de Marketing Digital', 'description' => 'Domina las estrategias y herramientas digitales para crear, gestionar y optimizar campañas de marketing exitosas.', 'category' => 'cursos', 'type' => 'service'],
            
            // Categoria: marketing -> type: service
            ['name' => 'Desarrollo de Marca (Branding)', 'description' => 'Creamos una identidad de marca completa, desde el logotipo hasta la estrategia de comunicación visual.', 'category' => 'marketing', 'type' => 'service'],
            ['name' => 'Paquete Facebook', 'description' => 'Incluye 20 posts en Facebook y una sesión de fotos. Un 25% de la inversión se destina a campañas en Facebook Ads.', 'price' => 6000, 'category' => 'marketing', 'type' => 'service'],
            ['name' => 'Paquete Meta', 'description' => 'Incluye 20 posts en Facebook e Instagram, más una sesión de fotos. Un 25% de la inversión se destina a campañas en Meta Ads.', 'price' => 9000, 'category' => 'marketing', 'type' => 'service'],
            ['name' => 'Paquete PRO', 'description' => 'Incluye 20 posts en Facebook, Instagram y TikTok, más una sesión de fotos. Un 25% de la inversión se destina a campañas publicitarias.', 'price' => 12000, 'category' => 'marketing', 'type' => 'service'],
        ];

        foreach ($products as $productData) {
            $categoryName = $productData['category'];
            if (isset($categories[$categoryName])) {
                Product::updateOrCreate(
                    ['name' => $productData['name']], 
                    [
                        'slug' => Str::slug($productData['name'].'-'.uniqid()),
                        'description' => $this->quillDescription($productData['description']),
                        'price' => $productData['price'] ?? null,
                        'category_id' => $categories[$categoryName],
                        'type' => $productData['type'],
                        'status' => 'active',
                    ]
                );
            } else {
                $this->command->warn("Omitiendo producto '{$productData['name']}' porque la categoría '{$categoryName}' no fue encontrada.");
            }
        }

        $this->command->info('Seeder de productos ejecutado correctamente.');

    }
    private function quillDescription(string $text): string
    {
        $trimmedText = trim($text);

    // If the text is empty after trimming, return an empty string.
    if (empty($trimmedText)) {
        return '';
    }

    // Split the text into an array of lines.
    $lines = explode("\n", $trimmedText);

    // Wrap each line in <p> tags, ensuring the content is properly escaped.
    $htmlParagraphs = array_map(function ($line) {
        return '<p>' . htmlspecialchars(trim($line), ENT_QUOTES, 'UTF-8') . '</p>';
    }, $lines);

    // Join the paragraphs back into a single HTML string.
    return implode('', $htmlParagraphs);
    }
}
