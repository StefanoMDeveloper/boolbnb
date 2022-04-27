<?php

namespace App\Http\Controllers\Admin;
use App\Image;
use App\Service;

use App\Apartment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function edit(Apartment $apartment){
        $user_id= Auth::user()->id;
        if($user_id == $apartment->user_id){
            return view('admin.images.edit',compact('apartment'));
        }
        return view('admin.404');        
    }

    public function store(Request $request, Apartment $apartment){
        $form_data=$request->all();
        if(isset($form_data['images'])) { 
            foreach($form_data['images'] as $image){
                $new_image = new Image();
                $img_path = Storage::put('uploads', $image);
                $new_image->url = $img_path;
                $new_image->main_image = false;
                $new_image->apartment()->associate($apartment);
                $new_image->save();
            }
        } 
        return view('admin.images.edit',compact('apartment'));
    }

    public function update(Request $request, Image $image)
    {
        $data=$image;
        $apartment = $image->apartment()->first();
        $images = $apartment->images()->get();
        $previousMainImage = $apartment->images()->where('main_image', '=', true)->get();
        if($previousMainImage->toArray()){
            $prevImage = $previousMainImage[0]->toArray();
            $prevImage['main_image']=false;
            $oldMainImage = Image::find($prevImage['id']);
            $oldMainImage->update($prevImage);
        }
        $data=$data->toArray();
        $data['main_image']=true;
        $image->update($data);
        $services = Service::all();
        return view('admin.images.edit',compact('apartment'));
    }

    public function destroy(Image $image)
    {
        $apartment = $image->apartment()->first();
        $image->delete();
        $services = Service::all();
        return view('admin.images.edit',compact('apartment'));
    }
}
