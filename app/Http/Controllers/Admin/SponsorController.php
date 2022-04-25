<?php

namespace App\Http\Controllers\Admin;

use App\Apartment;
use App\Sponsorship;
use Braintree\Gateway;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SponsorController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function sponsorize(Apartment $apartment, Gateway $gateway)
    {
        $sponsorships = Sponsorship::all();
        $token = $gateway->clientToken()->generate();
        return view('admin.sponsorize',compact('apartment','sponsorships','token'));
    }

    public function store(Request $request){
        $data=$request->all();
        $data['start_date'] = date('Y-m-d');
        $sponsorship = Sponsorship::find($data['sponsorship']);
        $apartment = Apartment::find($data['apartment']);
        $duration = ($sponsorship->duration)/24;
        $data['end_date'] = date('Y-m-d', strtotime($data['start_date']. ' + '.$duration.' days'));
        $sponsorship->apartments()->attach($apartment->id, array("start_date"=>$data["start_date"], "end_date"=>$data["end_date"]));
        return redirect()->route('admin.apartments.index')->with(["message"=>"sponsorizzazione avvenuta con successo!"]);
    }
}