<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserType\userTypeInterface as userTypeInterface;
use App\Http\Requests\manageUserTypeRequest;
use Illuminate\Support\Facades\Input;

class manageUserTypeController extends Controller
{   

    public function __construct(userTypeInterface $user_type){
        $this->user_type = $user_type;
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

        $data = $this->user_type->getAll($offset, $limit, $search);
        $data['offset'] = isset($_GET['all']) ? 'all' :$offset;
        $data['limit'] = isset($_GET['all']) ? 'all' : $limit;
        $data['total'] = 0;
        
        $data['total'] = $this->user_type->count();

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
    public function store(manageUserTypeRequest $request)
    {
         $data = Input::all();

         $user_type = $this->user_type->insert($data);

        if($user_type){
            return response()->json(['success'=> $user_type ], 200);
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
         $user_type = $this->user_type->find($id);

        if($user_type){
            return response()->json(['success'=>$user_type], 200);
        }else{
            return response()->json(['error'=>'User Type not found'], 401);
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
    public function update(manageUserTypeRequest $request, $id)
    {
        $data = Input::all();
        $user_type = $this->user_type->find($id);
        $data['id'] = $id;

        if($user_type){

            $update = $this->user_type->update($data);

            if(!$update){
               return response()->json(['error'=>'Server error'],500); 
            }else{
                $user_type = $this->user_type->find($id);
                return response()->json(['success'=>$user_type],200);
            }



        }else{
            return response()->json(['error'=>'User type not found'], 401);
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
        $user_type = $this->user_type->find($id);

        if($user_type){
            $deleted = $this->user_type->delete($id);

            if($deleted){
                return response()->json(['success'=>'successfully deleted user type.'],200);
            }else{
                return response()->json(['error'=>'Server error'],500);
            }
        }else{
            return response()->json(['error'=>'User Type not found'], 401);
        }
    }
}
