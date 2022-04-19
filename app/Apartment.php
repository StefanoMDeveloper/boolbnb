<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    protected $fillable = [
        'name', 'slug', 'description', 'rooms', 'beds', 'bathrooms', 'square_meters', 'address', 'visible', 'lat', 'lon', 'user_id'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function images(){
        return $this->hasMany('App\Image');
    }

    public function messages(){
        return $this->hasMany('App\Message');
    }

    public function views(){
        return $this->hasMany('App\View');
    }

    public function reviews(){
        return $this->hasMany('App\Review');
    }

    public function services(){
        return $this->belongsToMany('App\Service')->as('services_provided');
    }

    public function sponsorships(){
        return $this->belongsToMany('App\Sponsorship')->as('sponsorships_taken');
    }
}
