<?php

namespace Database\Seeders;

use App\Models\LanderSection;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class LanderSectionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lander_sections')->truncate();

        $defaultSections = [
            "productCards" => true,
            "impresion" => true,
            "puntosVenta" => true,
            "displayCursos" => true,
            "webDev" => true,
            "partners" => true,
            "experience" => true,
            "plans" => true,
            "gpadilla" => false
        ];

        foreach ($defaultSections as $name => $isActive) {
            LanderSection::create([
                'name' => $name,
                'is_active' => $isActive,
            ]);
        }
    }
}
