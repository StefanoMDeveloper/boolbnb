<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Apartment;

class ApartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $apartments = config('apartments');
        foreach ($apartments as $apartment){
            $new_apartment = new Apartment();
            $new_apartment->name = $apartment['name'];
            $new_apartment->slug = Str::of($apartment['name'])->slug("-");
            $new_apartment->description = $apartment['description'];
            $new_apartment->rooms = $apartment['rooms'];
            $new_apartment->beds = $apartment['beds'];
            $new_apartment->bathrooms = $apartment['bathrooms'];
            $new_apartment->square_meters = $apartment['square_meters'];
            $new_apartment->address = $apartment['address'];
            $new_apartment->visible = $apartment['visible'];
            $new_apartment->lat = $apartment['lat'];   
            $new_apartment->lon = $apartment['lon'];
            $new_apartment->user_id = $apartment['user_id'];
            $new_apartment->save();
        }
    }
}