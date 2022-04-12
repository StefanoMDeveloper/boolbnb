<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
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
            $new_services = new Service();
            $new_services->name = $service['name'];
            $new_services->slug = Str::of($service['name'])->slug("-");
            $new_services->save();
        }
    }
}
