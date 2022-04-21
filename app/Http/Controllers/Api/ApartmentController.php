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
        $apartments = Apartment::with(["images", "sponsorships", "services"])->get();
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
        $apartment = Apartment::where("slug", $slug)->with(["images", "sponsorships", "services", "views"])->first();
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

    public function geocode($search){
        $address = $search;
        $address = urlencode($address);
        $url = "https://api.tomtom.com/search/2/geocode/{$address}.json?key=5EIy0DQg5tZyBLLvAxNfCI6ei8DPGcte&limit=5&countrySet=IT&language=it-IT";
        $response_json = file_get_contents($url);
        return  json_decode($response_json, true);
    }

    public function autocomplete($search){
        $response = self::geocode($search);
        $resultings = [];
        foreach($response['results'] as $result){
            array_push($resultings, $result['address']);
        }
        return response()->json($resultings);
    }
    
    public function filter($search){
        $response = self::geocode($search);
        $searchLat=$response['results'][0]['position']['lat'];
        $searchLon=$response['results'][0]['position']['lon'];

        //First gross filter
        $apartments = Apartment::all()->whereBetween('lat', [$searchLat-0.5, $searchLat+0.5])->whereBetween('lon', [$searchLon-0.5, $searchLon+0.5]);
        if(empty($apartments)){
            return response()->json(["message"=>"Nessun appartamento."]);
        }

        $filteredApartments = [];

        foreach($apartments as $apartment){
            $dist = round(self::computeDistance($searchLat,$searchLon,$apartment->lat,$apartment->lon));
            if($dist<20000){
                $apartment['distance_from_search'] = $dist;
                array_push($filteredApartments, $apartment);
            }
        }

        if(empty($filteredApartments)){
            return response()->json([]);
        }

        return response()->json($filteredApartments);
    }
}
