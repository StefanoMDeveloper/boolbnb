<?php

namespace App\Http\Controllers\Admin;
use App\Image;
use App\Service;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ImageController extends Controller
{
    public function destroy(Image $image)
    {
        $apartment = $image->apartment()->first();
        $image->delete();
        $services = Service::all();
        return view('admin.apartments.edit',compact('apartment','services'));
    }
}
