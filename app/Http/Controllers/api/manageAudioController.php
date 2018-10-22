<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Audio\audioInterface as audioInterface;
use App\Http\Requests\manageAudioRequest;
use Illuminate\Support\Facades\Input;
use File;

class manageAudioController extends Controller
{
      public function __construct(audioInterface $audio){
        $this->audio = $audio;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = [];
        $offset = isset($_GET['offset']) ? $_GET['offset'] : 0;
        $limit = isset($_GET['limit']) ? $_GET['limit'] : 10;
        $search['all'] = true;
            
        if(isset($_GET["selected_session"])) {
            $search['selected_session'] = $_GET["selected_session"];
        }

        $data = $this->audio->getAll($offset, $limit, $search);

        foreach ($data as $key => $value) {
            $data[$key]["url"] = url()->current()."-view/".$data[$key]["url"];
        }

        $data['offset'] = isset($_GET['all']) ? 'all' :$offset;
        $data['limit'] = isset($_GET['all']) ? 'all' : $limit;
        $data['total'] = 0;

        $data['total'] = $this->audio->count();

        return response()->json(['success'=> $data ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {    
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(manageAudioRequest $request)
    {
      
        $data = Input::except("file");
        $music_file = $_FILES;
        $return = $this->audio->lastId();
        $next_id = $return["id"]+1;
        $data["url"] = $next_id."_".$music_file["file"]["name"];
        $destinationPath = storage_path('app') . '/public/audio/';
        $file = $request->file('file');
        $file->move($destinationPath, $data["url"]);
        $audio = $this->audio->insert($data);

        if($audio){
            return response()->json(['success'=> $audio ], 200);
        }else{
            return response()->json(['error'=>'Server error'], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $audio = $this->audio->find($id);

        if($audio){
            return response()->json(['success'=>$audio], 200);
        }else{
            return response()->json(['error'=>'Audio not found'], 401);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(manageAudioRequest $request, $id)
    {
       $data = Input::all();

       $audio = $this->audio->find($id);
       $data['id'] = $id;

       if($audio){

            $update = $this->audio->update($data);

            if(!$update){
               return response()->json(['error'=>'Server error'],500); 
            }else{
                $audio = $this->audio->find($id);
                return response()->json(['success'=>$audio],200);
            }



        }else{
            return response()->json(['error'=>'Audio not found'], 401);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $music = $this->music->find($id);

        if($music){
            $deleted = $this->music->delete($id);

            if($deleted){
                return response()->json(['success'=>'successfully deleted music.'],200);
            }else{
                return response()->json(['error'=>'Server error'],500);
            }
        }else{
            return response()->json(['error'=>'Music not found'], 401);
        }
    }

    public function viewAudio($filename) {
           $path = storage_path('app') . '/public/audio/' . $filename;

            if(!File::exists($path)){
                return response()->json(['error'=>'File not found'],400);
            }

            $file = File::get($path);
            $type = File::mimeType($path);

            $response = response()->make($file, 200);
            $response->header("Content-Type", $type);

            return $response;
    }
}
