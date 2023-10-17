<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    
    public function getAllCategories(Request $request)
    {
        $data = Category::orderBy('id', 'DESC')->get();

        return response()->json([
            'status' => true,
            'message' => '',
            'data' => $data
        ]);
    }

    public function saveCategory(Request $request)
    {
        $validator = \Validator::make($request->all(), [ 
            'name' => 'required|unique:categories,name,NULL,id,deleted_at,NULL',
        ]);

        if ($validator->fails()) { 
            return response()->json([
                'status' => false,
                'message' => 'Sorry! failed to create place',
                'data' => [],
                'errors'=> $validator->errors()
            ]);  
        }

        $categoryName = $request->name;
        $result = Category::create(['name' => $categoryName]);

        if($result)
        {
            return response()->json([
                'status' => true,
                'message' => 'Category created successfully',
                'data' => [],
                'errors'=> []
            ]);
        }
        
        return response()->json([
            'status' => false,
            'message' => 'Sorry! failed to create category',
            'data' => [],
            'errors'=> []
        ]);
        
    }

    public function getCategoryById($id)
    {
        $Result = Category::find($id);

        if($Result)
        {
            return response()->json([
                'status' => true,
                'message' => '',
                'data' => $Result,
                'errors'=> []
            ]);
        }
         
        return response()->json([
            'status' => false,
            'message' => '',
            'data' => $Result,
            'errors'=> []
        ]);
    }

    public function deleteCategory($id)
    {
        $Result = Category::where('id', $id)->delete();

        if($Result)
        {
            return response()->json([
                'status' => true,
                'message' => 'Success! Category deleted successfully',
                'data' => [],
                'errors'=> []
            ]);  
        }

        return response()->json([
            'status' => false,
            'message' => 'Sorry! Failed to delete category',
            'data' => [],
            'errors'=> []
        ]); 
    }


    public function updateCategory(Request $request)
    {
        $validator = \Validator::make($request->all(), [
            'id' => 'required|not_in:0',
            'name' => 'required|unique:categories,name,'.($request->id).',id,deleted_at,NULL',
        ]);

        if ($validator->fails()) { 
            return response()->json([
                'status' => false,
                'message' => 'Sorry! failed to create place',
                'data' => [],
                'errors'=> $validator->errors()
            ]);  
        }

        $Category = Category::find($request->id);
        $categoryName = $request->name;

        $result = $Category->update(['name' => $categoryName]);

        if($result)
        {
            return response()->json([
                'status' => true,
                'message' => 'Category updated successfully',
                'data' => [],
                'errors'=> []
            ]);
        }
        
        return response()->json([
            'status' => false,
            'message' => 'Sorry! failed to update category',
            'data' => [],
            'errors'=> []
        ]);
        
    }
}
