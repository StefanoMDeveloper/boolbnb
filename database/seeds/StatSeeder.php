<?php

use Illuminate\Database\Seeder;
use App\Stat;

class StatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $stats = config('stats');
        foreach ($stats as $stat){
            $new_stat = new Stat();
            $new_stat->id = $stat['id'];
            $new_stat->date = $stat['date'];
            $new_stat->apartment_id = $stat['apartment_id'];
            $new_stat->save();
        }
    }
}
