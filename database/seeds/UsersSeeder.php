<?php

use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = array(
            'username' => 'stkitziris',
            'name' => 'Stelios',
            'surname' => 'Kitziris',
            'email' => 'stkitziris@gmail.com',
            'email_verified_at' => now(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'remember_token' => Str::random(10),
            'status' => 1,
            'user_role_id' => 1
        );

        App\User::updateOrCreate(['id' => 1], $user);
    }
}
