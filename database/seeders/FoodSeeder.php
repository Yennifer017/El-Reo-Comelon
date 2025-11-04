<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('food')->insert([
            [
                'name' => 'Huevo',
                'price' => 1.25,
                'space' => 0.05,
                'url_image' => 'https://img.freepik.com/vector-premium/huevo-pixel-art-activo-juego_735839-166.jpg',
                'expires_at' => 30, 
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tocino',
                'price' => 3.50,
                'space' => 0.20,
                'url_image' => 'https://www.shutterstock.com/image-vector/bacon-pixel-art-icon-8bit-600nw-2151891045.jpg',
                'expires_at' => 10,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bolsa de Maseca',
                'price' => 2.75,
                'space' => 0.60,
                'url_image' => 'https://www.shutterstock.com/shutterstock/videos/3540251353/thumb/9.jpg?ip=x480',
                'expires_at' => 180,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Helado',
                'price' => 4.00,
                'space' => 0.50,
                'url_image' => 'https://img.freepik.com/vector-premium/helado-pixel-art-helado-8-bits_158677-423.jpg',
                'expires_at' => 90,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Pollo entero',
                'price' => 6.80,
                'space' => 1.20,
                'url_image' => 'https://img.freepik.com/vector-premium/vector-pollo-frito-tema-pixeles_580167-153.jpg',
                'expires_at' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Zanahoria',
                'price' => 0.75,
                'space' => 0.10,
                'url_image' => 'https://thumbs.dreamstime.com/b/imagen-de-zanahoria-p%C3%ADxel-ilustraci%C3%B3n-vectorial-para-juego-bits-y-trazo-cruzado-activos-dise%C3%B1o-costura-cruzada-o-camiseta-221875869.jpg',
                'expires_at' => 30,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Bolsa de arroz',
                'price' => 3.25,
                'space' => 0.70,
                'url_image' => 'https://img.freepik.com/vector-premium/sacos-arroz-estilo-pixel-art_475147-1240.jpg',
                'expires_at' => 365,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
