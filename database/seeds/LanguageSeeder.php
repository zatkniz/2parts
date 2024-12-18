<?php

use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = array(
            'Ελληνικά',
            'Αγγλικά',
            'Γαλλικά',
            'Γερμανικά',
            'Ισπανικά',
            'Ρώσικα',
            'Κινέζικα', 
            'Τούρκικα', 
            'Αραβικά', 
            'Ιαπωνικά', 
            'Σέρβικα', 
            'Άλλη γλώσσα',
        );

        foreach ( $languages as $value )
        {
            DB::table('languages')->insert([
                'name' => $value,
            ]);
        } 
    }
}
