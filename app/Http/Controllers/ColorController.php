<?php

namespace App\Http\Controllers;

use App\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
   
    public function index()
    {
        return Color::orderBy('id','desc')->get();

       // return view('categories.index',compact('categories'));
    }

    public function store(Request $request)
    {
        $new_record = Color::create([
            'color_name' => $request->color_name,
            'color_code' => $request->color_code,
        ]);
         return response()->json([
                'response_status'=>true,
                'message' => 'record has been created',
                'new_record' => Color::find($new_record->id)
            ]);
    }

   

    public function update(Request $request,$color_id)
    {

        $updated_record = Color::where('id',$color_id)
                                ->update([
                                    'color_name' => $request->color_name,
                                    'color_code' => $request->color_code
                                ]);

         return response()->json([
                'response_status'=>true,
                'message' => 'record has been updated',
                'updated_record' => Color::find($color_id)
            ]); 
     }

    public function destroy($color_id)
    {
                return (Color::find($color_id)->delete()) 
                ? [ 'response_status' => true,  'message' => 'record has been deleted' ] 
                : [ 'response_status' => false, 'message' => 'record cannot delete' ];
    }
}
