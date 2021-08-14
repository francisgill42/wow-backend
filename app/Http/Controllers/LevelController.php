<?php

namespace App\Http\Controllers;

use App\Level;
use App\Subject;
use Illuminate\Http\Request;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Level::all();
    }

    public function get_data_for_level($id){

    
        return response()->json([
            'subjects' => Subject::where('level_id',$id)->get()
        ]);
    
    }
    public function store(Request $request)
    {
        $new_record = Level::create(['level' => $request->level]);
        return response()->json([
               'response_status'=>true,
               'message' => 'record has been created',
               'new_record' => Level::find($new_record->id)
           ]);

    }

    public function update(Request $request, $id)
    {
        $updated_record = Level::where('id',$id)
        ->update([
        'level' => $request->level
        ]);

        return response()->json([
        'response_status'=>true,
        'message' => 'record has been updated',
        'updated_record' => Level::find($id)
        ]); 
    }

    public function destroy($id)
    {
        return (Level::find($id)->delete()) 
        ? [ 'response_status' => true,  'message' => 'record has been deleted' ] 
        : [ 'response_status' => false, 'message' => 'record cannot delete' ];
    }
}
