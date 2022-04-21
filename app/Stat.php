<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stat extends Model
{
    protected $fillable = [
        'ip', 'date', 'apartment_id'
    ];

    protected $dates = ['date'];

    public function apartment(){
        return $this->belongsTo('App\Apartment');
    }
    
}
