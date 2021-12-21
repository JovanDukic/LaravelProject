<?php

use App\CovidTest;
use App\UserTest;
use App\User;
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
        factory(User::class, 10)->create();

        CovidTest::create(['name' => 'PCR_Test']);
        CovidTest::create(['name' => 'QUICK_Test']);

        factory(UserTest::class, 10)->create();
    }
}
