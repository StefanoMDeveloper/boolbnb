<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = [
        'object', 'content', 'email', 'date', 'name', 'lastname', 'apartment_id'
    ];
    
    protected $dates = ['date'];

    public function apartment(){
        return $this->belongsTo('App\Apartment');
    }
}
