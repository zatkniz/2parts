<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Bank;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banks = [
            'Εθνική Τράπεζα',
            'Τράπεζα Πειραιώς',
            'Alpha Bank',
            'Eurobank',
            'POS Εθνική',
            'POS Eurobank',
        ];
        foreach ($banks as $bank) {
            Bank::updateOrCreate([
                'name' => $bank
            ]);
        }
    }
}
