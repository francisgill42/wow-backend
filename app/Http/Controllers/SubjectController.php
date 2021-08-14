<?php

namespace App\Http\Controllers;

use App\Level;
use App\Subject;
use App\Video;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arr = [];
        $subjects = Subject::all();
        foreach($subjects as $subject){
            $subject->level = $subject->level;
            $arr[$subject->level->level][] = $subject; 
            
        } 
        return $arr;


    }

    public function groupBySubject()
    {
        $arr = [];
        $subjects = Subject::all();
        foreach($subjects as $subject){
            $subject->level = $subject->level;
            $arr[$subject->level->level][] = $subject; 
            
        } 
        return $arr;

    }

    public function store(Request $request)
    {       

        $new_record = Subject::create([
            'level_id' => $request->level_id,
            'subject' => $request->subject
        ]);

		$res = ($new_record) 
        ? [ 'response_status'=>true, 'message' => 'record has been created' ]
        : [ 'response_status'=>false, 'message' => 'record cannot  create' ];

        return response()->json($res);
        


    }

    public function update(Request $request, $id)
    {
        $updated_record = Subject::where('id',$id)
        ->update([
        'level_id' => $request->level_id,
        'subject' => $request->subject
        ]);

        

        $level = Subject::find($id);
        $level->level = $level->level;
        $level[$level->level->level] = $level; 

        return response()->json([
        'response_status'=>true,
        'message' => 'record has been updated',
        'updated_record' => $level
        ]); 
    }


    public function destroy($id)
    {

    	$is_record = Video::where('subject_id',$id)->first();

    	if($is_record){
    	
    		Video::where('subject_id',$id)->delete();    	
    	}

    	return Subject::destroy($id)

    	? [ 'response_status' => true,  'message' => 'record has been deleted' ] 
		: [ 'response_status' => false, 'message' => 'record cannot delete' ];    		




    }
}
