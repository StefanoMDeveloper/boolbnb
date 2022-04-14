<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Apartment;
use App\Service;


class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $services = config('services');
        foreach ($services as $service){
            $new_service = new Service();
            $new_service->name = $service['name'];
            $new_service->slug = Str::of($service['name'])->slug("-");

            $new_service->save();
        }

        $apartments_services=config('apartments_services');
        foreach($apartments_services as $apartment_service){

            foreach(App\Service::all() as $service) {

                foreach(App\Apartment::all() as $apartment) {
    
                    if ($apartment['id']==$apartment_service['apartment_id'] && $service['id']==$apartment_service['service_id']) {
                            $service->apartments()->attach($apartment->id);
                    }
                }
                $service->save();
            }
        }
    }
}
