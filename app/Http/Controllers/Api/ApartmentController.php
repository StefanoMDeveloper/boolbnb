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

    public function filter($search){
        // geocoding
        $address = $search;
        $address = urlencode($address);
        $url = "https://api.tomtom.com/search/2/geocode/{$address}.json?key=5EIy0DQg5tZyBLLvAxNfCI6ei8DPGcte&limit=5&countrySet=IT&language=it-IT";
        $response_json = file_get_contents($url);
        $response = json_decode($response_json, true);
        $searchLat=$response['results'][0]['position']['lat'];
        $searchLon=$response['results'][0]['position']['lon'];

        //First gross filter
        $apartments = Apartment::all()->whereBetween('lat', [$searchLat-0.5, $searchLat+0.5])->whereBetween('lon', [$searchLon-0.5, $searchLon+0.5]);
        if(empty($apartments->items)){
            return response()->json(["message"=>"Nessun appartamento."]);
        }

        //listing apartments to pass on api call
        $apartmentList = [];
        $count = 0;
        foreach($apartments as $apartment){
            $apartmentJson =
                [
                    $count =>
                        [
                            "poi" => [
                            "name" => $apartment->name
                            ],
                            "address" => [
                            "freeformAddress" => $apartment->address
                            ],
                            "position" => [
                            "lat" => $apartment->lat,
                            "lon" => $apartment->lon
                            ],
                            [
                                "infos"  => 
                                    [
                                        "id"  => $apartment->id,
                                        "slug"  => $apartment->slug,
                                        "description" => $apartment->description,
                                        "beds"  => $apartment->beds,
                                        "bathrooms"  => $apartment->bathrooms,
                                        "square_meters"  => $apartment->square_meters,
                                        "user_id"  => $apartment->user_id
                                    ]
                            ]
                        ]
                ];
            array_push($apartmentList, $apartmentJson);
        }
        @dd($apartmentList);
        //other params for api call
        $latLon = $searchLat.",".$searchLon;
        $geometry = [
            [
            "type" => "CIRCLE",
            "position" => $latLon,
            "radius" => 20000
            ]
        ];

        //api call
        $url = "https://api.tomtom.com/search/2/geometryFilter.json?key=5EIy0DQg5tZyBLLvAxNfCI6ei8DPGcte&geometryList={$geometry}&poiList={$apartmentList}";
        $response_json = file_get_contents($url);
        $response = json_decode($response_json, true);
        return response()->json($response);
    }
}
