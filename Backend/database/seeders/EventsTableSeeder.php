<?php

namespace Database\Seeders;

use Cassandra\Date;
use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $event = new \App\Models\Event;
        $event->appointment= new DateTime();
        $event->people= "5";

//        $user = \App\Models\User::all()->first();
   //     $event->user()->associate($user);
        // raus nehmen aus Beziehung -> dissociate

        $location = \App\Models\Location::all()->first();
        $event->location()->associate($location);

        $event->save();

        // add images to event
        $image1 = new \App\Models\Image;
        $image1->title = "Cover 1";
        $image1->url = "https://images-na.ssl-images-amazon.com/images/I/61h%2BnIJyVFL._SX333_BO1,204,203,200_.jpg";

        $image2 = new \App\Models\Image;
        $image2->title = "Cover 2";
        $image2->url = "https://images-eu.ssl-images-amazon.com/images/I/516KV5tjulL._AC_US327_FMwebp_QL65_.jpg";
        $event->images()->saveMany([$image1,$image2]);

        //test locations
        /*
        $location = \App\Models\Location::where('id','=','1')->get();
        $event->location()->associate($location);

        $location = \App\Models\Location::all()->first();
        $event->location()->associate($location);

        $location4 = new \App\Models\Location;
        $location4->street = "Jägerstrasse";
        $location4->houseNumber = "12";
        $location4->postCode = "3100";
        $location4->town = "Sankt Pölten";
        $event->location()->save([$location4]);

        $location = \App\Models\Location::all()->first();
        $event->location()->saveMany([$location]);

        */



//        $event->save();
    }
}






