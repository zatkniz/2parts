<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
              $this->call(CountrySeeder::class);
              $this->call(LanguageSeeder::class);
              $this->call(CompanyTypeSeeder::class);
              $this->call(UserRoleSeeder::class);
              $this->call(ProductCategorySeeder::class);
              $this->call(UsersSeeder::class);
            //   factory(App\User::class,30)->create();
              factory(App\Company::class,20)->create();
              factory(App\Order::class,50)->create();
              factory(App\Scan::class,100)->create();
              factory(App\CompanyCategory::class,50)->create();
              factory(App\Product::class,50)->create();
              factory(App\OrderProduct::class,50)->create();
    }
}
