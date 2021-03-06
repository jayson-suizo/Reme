<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Activity\activityInterface as activityInterface;
use App\Http\Requests\manageActivityRequest;
use Illuminate\Support\Facades\Input;

class manageActivityController extends Controller
{   

    public function __construct(activityInterface $activity){
        $this->activity = $activity;
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

        $data = $this->activity->getAll($offset, $limit, $search);
        $data['offset'] = isset($_GET['all']) ? 'all' :$offset;
        $data['limit'] = isset($_GET['all']) ? 'all' : $limit;
        $data['total'] = 0;
        
        $data['total'] = $this->activity->count();

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
    public function store(manageActivityRequest $request)
    {
        $data = Input::all();

         $activity = $this->activity->insert($data);

        if($activity){
            return response()->json(['success'=> $activity ], 200);
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
        $activity = $this->activity->find($id);

        if($activity){
            return response()->json(['success'=>$activity], 200);
        }else{
            return response()->json(['error'=>'Activity not found'], 401);
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
    public function update(manageActivityRequest $request, $id)
    {   
        $data = Input::all();
        $activity = $this->activity->find($id);
        $data['id'] = $id;

        if($activity){

            $update = $this->activity->update($data);

            if(!$update){
               return response()->json(['error'=>'Server error'],500); 
            }else{
                $activity = $this->activity->find($id);
                return response()->json(['success'=>$activity],200);
            }



        }else{
            return response()->json(['error'=>'Activity not found'], 401);
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
       $activity = $this->activity->find($id);

        if($activity){
            $deleted = $this->activity->delete($id);

            if($deleted){
                return response()->json(['success'=>'successfully deleted user.'],200);
            }else{
                return response()->json(['error'=>'Server error'],500);
            }
        }else{
            return response()->json(['error'=>'Activity not found'], 401);
        }
    }
}
