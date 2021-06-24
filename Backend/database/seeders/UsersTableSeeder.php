<?php

namespace Database\Seeders;

use App\Models\Event;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //test user
        $user = new \App\Models\User;
        $user->name = 'testuser';
        $user->email = 'test@gmail.com';
        $user->password = bcrypt ('secret');
        $user->svnr = '1234';
        $user->save();

        $event = Event::first();

        $user->event()->associate($event)->save();
        $user->save();

    }
}
