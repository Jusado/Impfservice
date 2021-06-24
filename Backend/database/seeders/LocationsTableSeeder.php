<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class LocationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $location1 = new \App\Models\Location;
        $location1->street = "Linzerstraße";
        $location1->houseNumber = "3";
        $location1->postCode = "4210";
        $location1->town = "Gallneukirchen";
        $location1->save();

        $location2 = new \App\Models\Location;
        $location2->street = "Hauptsraße";
        $location2->houseNumber = "5";
        $location2->postCode = "4020";
        $location2->town = "Linz";
        $location2->save();

        $location3 = new \App\Models\Location;
        $location3->street = "Waldweg";
        $location3->houseNumber = "7";
        $location3->postCode = "5020";
        $location3->town = "Salzburg";
        $location3->save();

    }
}
