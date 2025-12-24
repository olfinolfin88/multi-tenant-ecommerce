<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name'  => 'Necklace',
                'description'   => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Maxime dolores cum voluptatibus molestias vitae enim facere magni corporis tempora? Veniam, maiores numquam voluptatem voluptate minus nesciunt soluta cumque voluptas neque.',
                'price' => 5,
                'stock' => 100,
            ],
            [
                'name'  => 'Ring',
                'description'   => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Maxime dolores cum voluptatibus molestias vitae enim facere magni corporis tempora? Veniam, maiores numquam voluptatem voluptate minus nesciunt soluta cumque voluptas neque.',
                'price' => 10,
                'stock' => 100,
            ],
            [
                'name'  => 'Bracelet',
                'description'   => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Maxime dolores cum voluptatibus molestias vitae enim facere magni corporis tempora? Veniam, maiores numquam voluptatem voluptate minus nesciunt soluta cumque voluptas neque.',
                'price' => 5,
                'stock' => 100,
            ],
            [
                'name'  => 'Beads',
                'description'   => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Maxime dolores cum voluptatibus molestias vitae enim facere magni corporis tempora? Veniam, maiores numquam voluptatem voluptate minus nesciunt soluta cumque voluptas neque.',
                'price' => 2,
                'stock' => 500,
            ],
        ];
        
        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
