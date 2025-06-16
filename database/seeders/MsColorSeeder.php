<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MsColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            ['color_id' => 1, 'color_name' => 'Default', 'hex_color' => '#5352ed'],
            ['color_id' => 2, 'color_name' => 'Turquoise', 'hex_color' => '#1abc9c'],
            ['color_id' => 3, 'color_name' => 'Salem', 'hex_color' => '#1E824C'],
            ['color_id' => 4, 'color_name' => 'Green Sea', 'hex_color' => '#16a085'],
            ['color_id' => 5, 'color_name' => 'Emerald', 'hex_color' => '#2ecc71'],
            ['color_id' => 6, 'color_name' => 'Nephritis', 'hex_color' => '#27ae60'],
            ['color_id' => 7, 'color_name' => 'Peter River', 'hex_color' => '#3498db'],
            ['color_id' => 8, 'color_name' => 'Green Darner Tail', 'hex_color' => '#74b9ff'],
            ['color_id' => 9, 'color_name' => 'Electron Blue', 'hex_color' => '#0984e3'],
            ['color_id' => 10, 'color_name' => 'Belize Hole', 'hex_color' => '#2980b9'],
            ['color_id' => 11, 'color_name' => 'Amethyst', 'hex_color' => '#9b59b6'],
            ['color_id' => 12, 'color_name' => 'Wisteria', 'hex_color' => '#8e44ad'],
            ['color_id' => 13, 'color_name' => 'Rebeccapurple', 'hex_color' => '#663399'],
            ['color_id' => 14, 'color_name' => 'Wet Asphalt', 'hex_color' => '#34495e'],
            ['color_id' => 15, 'color_name' => 'Midnight Blue', 'hex_color' => '#2c3e50'],
            ['color_id' => 16, 'color_name' => 'Asbestos', 'hex_color' => '#7f8c8d'],
            ['color_id' => 17, 'color_name' => 'Concrete', 'hex_color' => '#95a5a6'],
            ['color_id' => 18, 'color_name' => 'Silver', 'hex_color' => '#bdc3c7'],
            ['color_id' => 19, 'color_name' => 'Clouds', 'hex_color' => '#ecf0f1'],
            ['color_id' => 20, 'color_name' => 'Pomegranate', 'hex_color' => '#c0392b'],
            ['color_id' => 21, 'color_name' => 'Alizarin', 'hex_color' => '#e74c3c'],
            ['color_id' => 22, 'color_name' => 'Old Brick', 'hex_color' => '#96281B'],
            ['color_id' => 23, 'color_name' => 'Soft Red', 'hex_color' => '#EC644B'],
            ['color_id' => 24, 'color_name' => 'Pumpkin', 'hex_color' => '#d35400'],
            ['color_id' => 25, 'color_name' => 'Carrot', 'hex_color' => '#e67e22'],
        ];

        foreach ($colors as $color) {
            DB::table('ms_color')->insert([
                'color_id' => $color['color_id'],
                'color_name' => $color['color_name'],
                'hex_color' => $color['hex_color'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}