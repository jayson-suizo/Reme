<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Requests\userRegistrationRequest;
use Illuminate\Support\Facades\Input;
use App\Repositories\User\UserInterface as UserInterface;

class userController extends Controller
{
    public function __construct(UserInterface $user)
    {
        $this->user = $user;
    }
    /**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(){
        if(Auth::attempt(['email' => request('email'), 'password' => request('password')])){
            $user = Auth::user();
            $success['token'] =  $user->createToken('MyApp')->accessToken;
            return response()->json(['success' => $success], $this->successStatus);
        }
        else{
            return response()->json(['error'=>'Unauthorised'], 401);
        }

    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */

    public function register(userRegistrationRequest  $request)
    {
        $data = Input::all();
        $data["name"] = $data["first_name"] .' '.$data["last_name"];
        $data["password"] = bcrypt($data["password"]);
        $user = $this->user->insert($data);

        return response()->json(['success'=> $user]);

    }


    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {  
       $user = Auth::user();
        return response()->json(['success' => $user], $this->successStatus);
    }
}
