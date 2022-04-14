<?php

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
        $this->call(UserSeeder::class);
        $this->call(ApartmentSeeder::class);
        $this->call(ImageSeeder::class);
        $this->call(SponsorshipSeeder::class);
        $this->call(MessageSeeder::class);
        $this->call(ReviewSeeder::class);
        $this->call(ServiceSeeder::class);


    }
}
