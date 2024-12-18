<?php

use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = array(
            'Ορεκτικά',
            'Σαλάτες',
            'Κρεατικά',
            'Θαλασσινά',
            'Γλυκά',
            'Ποτά',
        );

        foreach ( $categories as $value )
        {
            DB::table('product_categories')->insert([
                'name' => $value,
            ]);
        } 
    }
}
