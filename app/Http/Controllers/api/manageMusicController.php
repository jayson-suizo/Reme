<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Music\musicInterface as musicInterface;
use App\Http\Requests\manageMusicRequest;
use Illuminate\Support\Facades\Input;


class manageMusicController extends Controller
{   

    public function __construct(musicInterface $music){
        $this->music = $music;
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

        if(isset($_GET['all'])){
            $search['all'] = true;
        }
        
        // if(isset($_GET['name'])){
        //     $search['name'] = $_GET['name'];
        // }

        $data = $this->music->getAll($offset, $limit, $search);
        $data['offset'] = isset($_GET['all']) ? 'all' :$offset;
        $data['limit'] = isset($_GET['all']) ? 'all' : $limit;
        $data['total'] = 0;
        
        $data['total'] = $this->music->count();

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
    public function store(manageMusicRequest $request)
    {
      
        $data = Input::all();

        $music = $this->music->insert($data);

        if($music){
            return response()->json(['success'=> $music ], 200);
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
        $music = $this->music->find($id);

        if($music){
            return response()->json(['success'=>$music], 200);
        }else{
            return response()->json(['error'=>'Music not found'], 401);
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
    public function update(manageMusicRequest $request, $id)
    {
       $data = Input::all();
        $music = $this->music->find($id);
        $data['id'] = $id;

        if($music){

            $update = $this->music->update($data);

            if(!$update){
               return response()->json(['error'=>'Server error'],500); 
            }else{
                $music = $this->music->find($id);
                return response()->json(['success'=>$music],200);
            }



        }else{
            return response()->json(['error'=>'Music not found'], 401);
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
}
