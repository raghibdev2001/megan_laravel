<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\Image;
use Validator;

class PlacesController extends Controller
{
    public function getAllPlaces()
    {
        $UserId = \Auth::id();

        $Places = Place::select('id','place_title','available_from', 'available_to')
                    ->where('created_by', $UserId)
                    ->get();
        
        return response()->json([
            'status' => true,
            'message' => '',
            'data' => $Places,
            'errors'=> []
        ]);  
    }

    public function savePlaces(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'place_title' => 'required',
            'price' => 'required',
            'available_from' => 'required',
            'available_to' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
        ]);

        if ($validator->fails()) { 
            return response()->json([
                'status' => false,
                'message' => 'Sorry! failed to save place',
                'data' => [],
                'errors'=> $validator->errors()
            ]);  
        }


        $placeData = [
            'place_title'    => $request->place_title,
            'price'          => $request->price,
            'available_from' => $request->available_from,
            'available_to'   => $request->available_to,
            'latitude'       => $request->latitude,
            'longitude'      => $request->longitude,
            'created_by'      => \Auth::id(),
            'updated_by'      => \Auth::id(),
        ];  

        // title image
        if($request->has('image'))
        {
            $image = $request->file('image');

            $fileName  = time().'_'.$image->getClientOriginalName();

            $path = $image->storeAs('upload/places', $fileName, 'public');
            
            if(!$path)
            {
                return response()->json([
                    'status' => false,
                    'message' => 'Failed to upload image file',
                    'data' => [$path],
                    'errors'=> []
                ]);  
            }

            $placeData['title_image'] = $fileName; 
            
        }
        else
        {
            return response()->json([
                'status' => false,
                'message' => 'Title image is required',
                'data' => [],
                'errors'=> []
            ]);  
        }
        //End title image

        $place = Place::create($placeData);

        if($place)
        {
            //More Images
            $MoreImages = [];
            if($request->has('more_images'))
            {
                $more_image = $request->file('more_images');

                foreach($more_image as $key => $image)
                {
                    $fileName  = time().'_'.$image->getClientOriginalName();

                    $MoreImages[] = $image->storeAs('upload/places', $fileName, 'public');
                    
                    $place->images()->create([
                        'image_name' => $fileName
                    ]);	
                }
                
                
                if(!$MoreImages)
                {
                    return response()->json([
                        'status' => false,
                        'message' => 'Failed to upload image file2',
                        'data' => [],
                        'errors'=> []
                    ]);  
                }
                
            }
            //End More Images

            return response()->json([
                'status' => true,
                'message' => 'Success! Place added successfully',
                'data' => [],
                'errors'=> []
            ]);  
        }
        
        return response()->json([
            'status' => false,
            'message' => 'Sorry! Failed to add place',
            'data' => [],
            'errors'=> []
        ]);  
    }

    public function deletePlace(Request $request)
    {
        $PlaceId = $request->id;
        
        $result = Place::where('id', $PlaceId)->delete();

        if($result)
        {
            return response()->json([
                'status' => true,
                'message' => 'Success! Place deleted successfully',
                'data' => [],
                'errors'=> []
            ]);  
        }

        return response()->json([
            'status' => false,
            'message' => 'Sorry! Failed to delete place',
            'data' => [],
            'errors'=> []
        ]);  
    }
}
