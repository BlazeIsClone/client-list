<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Company;
use App\Models\User;
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
        User::factory()->count(15)->create();
        Client::factory()->count(100)->create();
        Company::factory()->count(50)->create();
    }
}
