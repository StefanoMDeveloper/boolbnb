<?php

use Illuminate\Database\Seeder;
use App\Image;

class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = config('apartments_images');
        foreach ($images as $image){
            $new_image = new Image();
            $new_image->url = $image['url'];
            $new_image->main_image = $image['main_image'];
            $new_image->apartment_id = $image['apartment_id'];
            $new_image->save();
        }
    }
}
