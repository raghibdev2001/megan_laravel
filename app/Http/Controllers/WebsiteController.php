<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;

class WebsiteController extends Controller
{
    public function getPlaces()
    {
        $Place = Place::with("images")->get();
        
        return response()->json([
            'status' => true,
            'message' => '',
            'data' => $Place 
        ], 200);
    }
}
