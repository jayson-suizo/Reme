<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Requests\userRegistrationRequest;
use Illuminate\Support\Facades\Input;

class userController extends Controller
{
    public $successStatus = 200;


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

    public function register(userRegistrationRequest $request)
    {   $data = Input::all();
        $validator = validator($data);
        print_r($validator);
        die;
        if ($validator->fails()) {
            echo 1;
            die;
            return response()->json(
            	['error'=>$validator->errors()], 401);            
        }else{
            echo 1;
            die;
        }

        // $input = $request->all();
        // $input['password'] = bcrypt($input['password']);
        // $user = User::create($input);
        // $success['token'] =  $user->createToken('MyApp')->accessToken;
        // $success['name'] =  $user->name;

        // return response()->json(['success'=>$success], $this->successStatus);

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
