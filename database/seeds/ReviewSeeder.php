<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Review;

class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $reviews = config('review');
        foreach($reviews as $review){
            $newReview = new Review();
            $newReview->title = $review['title'];
            $newReview->content = $review['content'];
            $newReview->rating = $review['rating'];
            $newReview->date = $review['date'];
            $newReview->name = $review['name'];
            $newReview->lastname = $review['lastname'];
            $newReview->apartment_id = $review['apartment_id'];
            $newReview->save();
        }
    }
}
