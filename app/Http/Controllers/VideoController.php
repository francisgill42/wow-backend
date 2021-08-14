<?php

namespace App\Http\Controllers;

use App\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $videos = Video::all();
        foreach($videos as $v){
            $v->subject = $v->subject; 
        }
        foreach($videos as $v){            
            $v->level = \App\Level::where('id',$v->subject->level_id)->first();
        }
        return $videos;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_record = Video::create([
            'title' => $request->title,
            'link' => $request->link,
            'subject_id' => $request->subject_id,
        ]);
        $new_record->subject = $new_record->subject;
        $new_record->level = \App\Level::where('id',$new_record->subject->level_id)->first();

        return response()->json([
        'response_status'=>true,
        'message' => 'record has been created',
        'new_record' => $new_record
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {

        
        $updated = Video::where('id',$id)->update([
            'title' => $request->title,
            'link' => $request->link,
            'subject_id' => $request->subject_id,
        ]);
        if($updated){
            $updated = \App\Video::where('id',$id)->first();
            $updated->subject = $updated->subject;            
            $updated->level = \App\Level::where('id',$updated->subject->level_id)->first();
        }

        return response()->json([
        'response_status'=>true,
        'message' => 'record has been created',
        'updated_record' => $updated
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Video  $video
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        return (Video::find($id)->delete()) 
        ? [ 'response_status' => true,  'message' => 'record has been deleted' ] 
        : [ 'response_status' => false, 'message' => 'record cannot delete' ];
    }
}
