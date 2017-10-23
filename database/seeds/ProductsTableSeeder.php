<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('products')->insert(
            [
                'sku' => '9999999',
                'title' => 'TEST',
                'description' => 'lorem test impsum test',
                'price' => 9.99,
                'availability' => true,
                'color' => 'white',
                'dimensions' => '9x9x9'
            ]
        );
    }
}
