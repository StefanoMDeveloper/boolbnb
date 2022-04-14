<?php

use Illuminate\Database\Seeder;
use App\Sponsorship;

class SponsorshipSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sponsorships = config('sponsorships');
        foreach ($sponsorships as $sponsorship){
            $new_sponsorship = new Sponsorship();
            $new_sponsorship->name = $sponsorship['name'];
            $new_sponsorship->price = $sponsorship['price'];
            $new_sponsorship->duration = $sponsorship['duration'];

            $new_sponsorship->save();
        }

        $apartments_sponsorships = config('apartments_sponsorships');
        foreach($apartments_sponsorships as $apartments_sponsorship){
            foreach(App\Sponsorship::all() as $sponsorship) {

                foreach(App\Apartment::all() as $apartment) {
    
                    if ($apartment['id']==$apartments_sponsorship['apartment_id'] && $sponsorship['id']==$apartments_sponsorship['sponsorship_id']) {
                        // return var_dump($apartments_sponsorship);
                            $sponsorship->apartments()->attach($apartment->id, array("start_date"=>$apartments_sponsorship["start_date"], "end_date"=>$apartments_sponsorship["end_date"]));
                    }
                }
                $sponsorship->save();
            }
        }
    }
}

