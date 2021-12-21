<?php

use App\CovidTest;
use App\UserTest;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(User::class, 20)->create();

        User::create(['name' => 'admin', 'email' => 'admin@gmail.com', 'password' => Hash::make('admin')]);

        CovidTest::create(['name' => 'PCR_Test']);
        CovidTest::create(['name' => 'QUICK_Test']);

        factory(UserTest::class, 20)->create();
    }
}
