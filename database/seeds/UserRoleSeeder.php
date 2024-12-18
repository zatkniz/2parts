<?php

use Illuminate\Database\Seeder;

class UserRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = array(
            'Διαχειριστής',
            'Καταστηματάρχης',
            'Χρήστης'
        );

        foreach ( $roles as $value )
        {
            DB::table('user_roles')->insert([
                'name' => $value,
            ]);
        } 
    }
}
