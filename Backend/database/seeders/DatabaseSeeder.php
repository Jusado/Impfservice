<?php

namespace Database\Seeders;

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
        $this->call(LocationsTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(UsersTableSeeder::class);
    }
}
