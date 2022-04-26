<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Apartment;

class ApartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments = Apartment::with(["images", "active_sponsorships", "services"])->get();
        return response()->json($apartments);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $apartment = Apartment::where("slug", $slug)->with(["images","services","stats"])->first();
        if (empty($apartment)){
            return response()->json(["message"=>"Nessun appartamento trovato con questo nome!"]);
        }
        return response()->json($apartment);
    }

    public function computeDistance($lat1, $lng1, $lat2, $lng2, $radius = 6378137)
    {
        static $x = M_PI / 180;
        $lat1 *= $x; $lng1 *= $x;
        $lat2 *= $x; $lng2 *= $x;
        $distance = 2 * asin(sqrt(pow(sin(($lat1 - $lat2) / 2), 2) + cos($lat1) * cos($lat2) * pow(sin(($lng1 - $lng2) / 2), 2)));
    
        return $distance * $radius;
    }  
    
    public function filter($search,$radius,$beds,$rooms,$lat,$lon,$services){
        //get Services requested
        if(isset($services)){
            $serviceList = explode("-",$services);
        }

        //First gross filter
        $apartments = Apartment::with(["images", "active_sponsorships", "services"])->get();

        //filter by beds
        $filteredApartments=[];
        foreach($apartments as $apartment){
            if($apartment->beds >= $beds){
                array_push($filteredApartments, $apartment);
            }
        }

        //filter by rooms
        $apartments = [];
        foreach ($filteredApartments as $apartment){
            if($apartment->rooms >= $rooms){
                array_push($apartments, $apartment);
            }
        }

        //filter by service
        $filteredApartments=[];
        $checkVar = false;
        foreach($apartments as $apartment){
            $servicing = $apartment->services->toArray();
            for($i=0;$i<count($servicing);$i++){
                $servicing[$i] = $servicing[$i]['id'];
            }
            foreach($serviceList as $service){
                if(in_array($service, $servicing)){
                    $checkVar = true;
                }
                else{
                    $checkVar = false;
                    break 1;
                }
            }
            if($checkVar){
                array_push($filteredApartments, $apartment);
            }
        }

        //filter by distance
        $apartments = [];
        foreach($filteredApartments as $apartment){
            $dist = round(self::computeDistance($lat,$lon,$apartment->lat,$apartment->lon));
            if($dist<$radius){
                $apartment['distance_from_search'] = $dist;
                array_push($apartments, $apartment);
            }
        }

        if(empty($apartments)){
            return response()->json([]);
        }

        return response()->json($apartments);
    }
}
