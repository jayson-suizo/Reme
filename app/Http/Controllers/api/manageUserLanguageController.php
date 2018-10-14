<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Repositories\userLanguage\userLanguageInterface as userLanguageInterface;
use App\Http\Requests\manageUserLanguageRequest;

class manageUserLanguageController extends Controller
{   

    public function __construct(userLanguageInterface $user_language){
        $this->user_language = $user_language;
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

        if(isset($_GET['user_id'])){
            $search['user_id'] = $_GET['user_id'];
        }

        $data = $this->user_language->getAll($offset, $limit, $search);
        $data['offset'] = isset($_GET['all']) ? 'all' :$offset;
        $data['limit'] = isset($_GET['all']) ? 'all' : $limit;
        $data['total'] = 0;
        
        $data['total'] = $this->user_language->count();

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
    public function store(manageUserLanguageRequest $request)
    {
       $data = Input::all();

        $user_language = $this->user_language->insert($data);

        if($user_language){
            return response()->json(['success'=> $user_language ], 200);
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

        $user_language = $this->user_language->find($id);
        if($user_language){
            return response()->json(['success'=>$user_language], 200);
        }else{
            return response()->json(['error'=>'User language not found'], 401);
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
    public function update(manageUserLanguageRequest $request, $id)
    {
        $data = Input::all();
        $user_language = $this->user_language->find($id);
        $data['id'] = $id;

        if($user_language){

            $update = $this->user_language->update($data);

            if(!$update){
               return response()->json(['error'=>'Server error'],500); 
            }else{
                $user_language = $this->user_language->find($id);
                return response()->json(['success'=>$user_language],200);
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
        $user_language = $this->user_language->find($id);

        if($user_language){
            $deleted = $this->user_language->delete($id);

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
