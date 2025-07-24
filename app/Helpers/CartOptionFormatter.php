<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CartOptionFormatter
{
    /**
     * Formatea una opción de producto del carrito para mostrarla al usuario.
     *
     * @param string $optionName El nombre de la opción (ej. 'alto', 'tipo_vinilo').
     * @param mixed $optionValue El valor de la opción.
     * @return string|null La cadena de texto formateada o null si no debe mostrarse.
     */
    public static function format(string $optionName, $optionValue): ?string
    {
        $valueTranslations = [
            'cara' => [
                'una-cara' => 'Una Cara',
                'doble-cara' => 'Doble Cara',
            ],
            'tipo_vinilo' => [
                'cortado' => 'Vinilo Cortado',
                'impreso' => 'Vinilo Impreso',
                'microperforado' => 'Vinilo Microperforado',
            ],
            'design_choice' => [
                'professional' => 'Solicitó diseño profesional',
                'upload' => 'Adjuntó su propio diseño',
            ],
        ];

        return match ($optionName) {
            'color' => "<strong>Color:</strong> {$optionValue}",
            'alto' => "<strong>Alto:</strong> {$optionValue} m",
            'ancho' => "<strong>Ancho:</strong> {$optionValue} m",
            'diametro' => "<strong>Diámetro:</strong> {$optionValue} cm",
            'tamano' => "<strong>Tamaño:</strong> {$optionValue}",
            'cantidad' => "<strong>Cantidad:</strong> {$optionValue}",
            'cara', 'tipo_vinilo', 'design_choice' => 
                '<strong>' . ucfirst(str_replace('_', ' ', $optionName)) . ':</strong> ' . ($valueTranslations[$optionName][$optionValue] ?? $optionValue),
            'detalles_extra' => "<strong>Detalles extra:</strong> {$optionValue}",
            'idea' => "<strong>Idea para el diseño:</strong> {$optionValue}",
            
            'design' => $optionValue ? '<strong>Diseño:</strong> <a href="' . Storage::url($optionValue) . '" target="_blank" class="text-mktPurple hover:underline">Ver archivo adjunto</a>' : null,
            
            'no_cotizacion', 'professional_design' => null,

            // Un caso por defecto por si se añade una opción no contemplada, lo hiciste de nuevo, German Padiilla.
            default => '<strong>' . ucfirst(str_replace('_', ' ', $optionName)) . ":</strong> {$optionValue}",
        };
    }
}