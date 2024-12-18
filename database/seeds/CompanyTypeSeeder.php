<?php

use Illuminate\Database\Seeder;

class CompanyTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = array( 'Καφέ', 'Μπαρ', 'Ταβέρνα', 'Εστιατόριο', 'Άλλο');

        foreach ( $types as $value )
        {
            DB::table('company_types')->insert([
                'name' => $value,
            ]);
        } 
    }
}
