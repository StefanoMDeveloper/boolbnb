<?php

namespace App\Http\Controllers\Admin;

use App\Apartment;
use App\Image;
use App\Service;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ApartmentController extends Controller
{
    protected $validation = [
        'name'=>'required|string|max:20',
        'description'=>'required|string',
        'rooms'=>'required|integer|max:2',
        'beds'=>'required|integer|max:2',
        'bathrooms'=>'required|integer|max:2',
        'square_meters'=>'required|integer|max:3',
        'address'=>'required|string|max:80',
        'visible'=>'required|boolean',
        'user_id'=>'required',
        'image'=>'exists:images,id',
        'services'=>'exists:services,id '
    ];


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $apartments=Apartment::all();
        $images=Image::all();
        $services=Service::all();
        return view('admin.apartments.index',compact('apartments','services','images'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $images = Image::all();
        $services = Service::all();
        return view('admin.apartements.create',compact('images','services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $form_data=$request->all();
        // fetch user id
        $user_id = $request->user()->id;
        $form_data['user_id'] = $user_id;

        //validation
        $request->validate($this->validation);

        $apartment = new Apartment();   

        //slug
        $slugName= Str::slug($form_data['name']);
        $count = 2;
        while(Apartment::where('slug',$slugName)->first()){
            $slugName=Str::slug($form_data['name'])."-".$count;
            $count++;
        }
        $form_data['slug'] = $slugName;

        $apartment->fill($form_data);

        $apartment->save();

        //pivot
        $apartment->services()->sync(isset($form_data['services']) ? $form_data['services'] : [] );

        return redirect()->route('admin.apartments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function show(Apartment $apartment)
    {
        $images = Image::all();
        $services = Service::all();
        return view('admin.apartments.show',compact('apartment','images','services'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function edit(Apartment $apartment)
    {
        $images = Image::all();
        $services = Service::all();
        return view('admin.apartments.edit',compact('apartment','images','services'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Apartment $apartment)
    {
        //fetch user id
        $user_id = $request->user()->id;
        $request['user_id'] = $user_id;

        //validation
        $request->validate($this->validation);

        $form_data=$request->all();
        
        //slug 
        if(!($form_data['name'] == $apartment->name)){
            $count = 2;
            $slugName= Str::slug($form_data['name']);
            while(Apartment::where('slug',$slugName)->first()){
                $slugName=Str::slug($form_data['name'])."-".$count;
                $count++;
            }
            $form_data['slug'] = $slugName;
        }

        $apartment->update($form_data);
        $apartment->services()->sync(isset($form_data['services']) ? $form_data['services'] : [] );

        return redirect()->route('admin.apartments.show',compact('apartment'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Apartment  $apartment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Apartment $apartment)
    {
        $apartment->delete();

        return redirect()->route('admin.apartment.index')->with(["message"=>"Il tuo appartamento è stato eliminato!"]);
    }
}
