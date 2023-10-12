<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Place;
use App\Models\Image;
use App\Models\Amenity;
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
            'short_description' => 'required',
            'location' => 'required',
            'about_place' => 'required',
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
            'short_description' => $request->short_description,
            'location'          => $request->location,
            'about_place'       => $request->about_place,
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

        $Amenities =  json_decode($request->amenities, true);
        $arrAmenity = [];
        
        foreach($Amenities as $Amenity)
        {
            array_push($arrAmenity, array('amenity_id'=>$Amenity['value']));
        }

        $place = Place::create($placeData);
        
        if($place)
        {
            if($arrAmenity)
            {
                $place->Amenities()->attach($arrAmenity);
            }

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


    public function getPlaceById(Request $request)
    {
        $PlaceId = $request->id;
        $GetImages = $request->get_images;
        
        $Result = Place::find($PlaceId);
        $data = [];

        if($Result)
        {
            $data = [
                'id'=>$Result->id,
                'place_title'=>$Result->place_title,
                'short_description'=>$Result->short_description,
                'location'=>$Result->location,
                'about_place'=>$Result->about_place,
                'price'=>$Result->price,
                'available_from'=>$Result->available_from,
                'available_to'=>$Result->available_to,
                'latitude'=>$Result->latitude,
                'longitude'=>$Result->longitude,
                'amenities'=>[],
            ];

            if($GetImages)
            {
                $data['title_image'] = $Result->title_image; 
                $data['more_images'] = $Result->images; 
            }

            if($Result->Amenities)
            {
                foreach($Result->Amenities as $Amenity)
                {
                    $data['amenities'][] = array('value'=>$Amenity->id, 'label'=>$Amenity->amenity_name);
                }
            }

            return response()->json([
                'status' => true,
                'message' => '',
                'data' => $data,
                'errors'=> []
            ]);
        }
         
        
        return response()->json([
            'status' => false,
            'message' => '',
            'data' => $data,
            'errors'=> []
        ]);
    }

    public function updatePlaces(Request $request)
    {
        $validator = Validator::make($request->all(), [ 
            'place_title' => 'required',
            'short_description' => 'required',
            'location' => 'required',
            'about_place' => 'required',
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
            'short_description' => $request->short_description,
            'location'          => $request->location,
            'about_place'       => $request->about_place,
            'price'          => $request->price,
            'available_from' => $request->available_from,
            'available_to'   => $request->available_to,
            'latitude'       => $request->latitude,
            'longitude'      => $request->longitude,
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
        
        //End title image
        $Place = Place::find($request->id);
        $Result = $Place->update($placeData);

        if($Result)
        {
            //More Images
            $MoreImages = [];
            if($request->has('more_images'))
            {
                $more_image = $request->file('more_images');
                
                Image::where('imageable_id', $Place->id)->delete();

                foreach($more_image as $key => $image)
                {
                    $fileName  = time().'_'.$image->getClientOriginalName();

                    $MoreImages[] = $image->storeAs('upload/places', $fileName, 'public');
                    
                    $Place->images()->create([
                        'image_name' => $fileName
                    ]);	
                }
            }
            //End More Images

            return response()->json([
                'status' => true,
                'message' => 'Success! Place updated successfully',
                'data' => [],
                'errors'=> []
            ]);  
        }
        
        return response()->json([
            'status' => false,
            'message' => 'Sorry! Failed to update place',
            'data' => [],
            'errors'=> []
        ]);  
    }

    public function deletePlace(Request $request)
    {
        $PlaceId = $request->id;
        
        $Result = Place::where('id', $PlaceId)->delete();

        if($Result)
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


    public function getAmenities(Request $request)
    {
        $Amenities = Amenity::select('id as value', 'amenity_name as label')->get();

        return response()->json([
            'status' => true,
            'message' => '',
            'data' => $Amenities,
            'errors'=> []
        ]); 
    }
    
}
