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

    public function stats(){
        return $this->hasMany('App\Stat');
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

    public function active_sponsorships(){
        $currentDate = date('Y-m-d');
<<<<<<< HEAD
        return $this->sponsorships()->withPivot('start_date','end_date')->where('start_date','<=' , $currentDate)->where('end_date', '>=', $currentDate);
=======
        return $this->sponsorships()->using('App\ApartmentSponsorship')->withPivot('start_date','end_date')->where('start_date','<=' , $currentDate)->where('end_date', '>=', $currentDate);
>>>>>>> e13a70186ffcd003909715167799f2dcbd13aa4f
    }
}
