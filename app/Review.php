<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $fillable = [
        'title', 'content', 'rating', 'date', 'name', 'lastname', 'apartment_id'
    ];

    public function apartment(){
        return $this->belongsTo('App\Apartment');
    }
}
