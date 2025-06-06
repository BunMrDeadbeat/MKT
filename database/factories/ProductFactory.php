<?php

namespace Database\Factories;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * 
     * @return array<string, mixed>
     */
    protected $model = Product::class;
    public function definition(): array
    {
        
        $name = $this->faker->words(2, true); // Genera un nombre aleatorio
        return [
            'name' => $name,
            'slug' => Str::slug($name) . '-' . $this->faker->unique()->numberBetween(1000, 9999), // Asegura slug único
            'description' => $this->faker->optional()->paragraph, // Campo nullable
            'type' => $this->faker->randomElement(['product', 'service']), // Valores del enum
            'price' => $this->faker->randomFloat(2, 10, 1000), // Decimal con 2 decimales
            'category_id' => $this->faker->randomFloat(0,1,4), // Elige una categoría
            'status' => $this->faker->randomElement(['active', 'inactive'])
        ];
    }
}