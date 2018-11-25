<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Group\groupInterface as groupInterface;
use App\Http\Requests\manageGroupRequest;
use Illuminate\Support\Facades\Input;

class manageGroupController extends Controller
{   
    public function __construct(groupInterface $group){
        $this->group = $group;
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
        $search["user_id"] = isset($_GET['user_id']) ? $_GET['user_id'] : 0;

        $search['all'] = true;

        $data = $this->group->getAll($offset, $limit, $search);
        $data['offset'] = isset($_GET['all']) ? 'all' :$offset;
        $data['limit'] = isset($_GET['all']) ? 'all' : $limit;
        $data['total'] = 0;
        
        $data['total'] = $this->group->count();

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
    public function store(manageGroupRequest $request)
    {
        $data = Input::all();

        $group = $this->group->insert($data);

        if($group){
            return response()->json(['success'=> $group ], 200);
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
        $group = $this->group->find($id);

        if($group){
            return response()->json(['success'=>$group], 200);
        }else{
            return response()->json(['error'=>'Group not found'], 401);
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
    public function update(manageGroupRequest $request, $id)
    {   
        $data = Input::all();
        $group = $this->group->find($id);
        $data['id'] = $id;

        if($group){

            $update = $this->group->update($data);

            if(!$update){
               return response()->json(['error'=>'Server error'],500); 
            }else{
                $group = $this->group->find($id);
                return response()->json(['success'=>$group],200);
            }



        }else{
            return response()->json(['error'=>'Group not found'], 401);
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
        $group = $this->group->find($id);

        if($group){
            $deleted = $this->group->delete($id);

            if($deleted){
                return response()->json(['success'=>'successfully deleted Group.'],200);
            }else{
                return response()->json(['error'=>'Server error'],500);
            }
        }else{
            return response()->json(['error'=>'Group not found'], 401);
        }
    }
}
