<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\User\UserInterface as UserInterface;
use App\Http\Requests\manageUserRequest;
use Illuminate\Support\Facades\Input;

class manageUserController extends Controller
{   

    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(manageUserRequest $request)
    {
        $data = Input::all();
        $data["name"] = $data["first_name"] .' '.$data["last_name"];
        $data["password"] = bcrypt($data["password"]);

        $user = $this->user->insert($data);

        if($user){
            return response()->json(['success'=> $user ], 200);
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
        $user = $this->user->find($id);

        if($user){
            return response()->json(['success'=>$user], 200);
        }else{
            return response()->json(['error'=>'User not found'], 401);
        }
    }

   
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(manageUserRequest $request, $id)
    {
        $user = $this->user->find($id);
        $data = Input::all();
        $data['id'] = $id;
        $data["name"] = $data["first_name"] .' '.$data["last_name"];

        if($user){

            if($data["email"] == $user["email"]){
                unset($data["email"]);
            }
            $update = $this->user->update($data);

            if(!$update){
               return response()->json(['error'=>'Server error'],500); 
            }else{
                $user = $this->user->find($id);
                return response()->json(['success'=>$user],200);
            }



        }else{
            return response()->json(['error'=>'User not found'], 401);
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
        $user = $this->user->find($id);

        if($user){
            $deleted = $this->user->delete($id);

            if($deleted){
                return response()->json(['success'=>'successfully deleted user.'],200);
            }else{
                return response()->json(['error'=>'Server error'],500);
            }
        }else{
            return response()->json(['error'=>'User not found'], 401);
        }
    }
}
