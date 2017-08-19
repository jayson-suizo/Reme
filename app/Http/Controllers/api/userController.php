<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Requests\userRegistrationRequest;
use App\Http\Requests\verificationRequest;
use Illuminate\Support\Facades\Input;
use App\Repositories\User\UserInterface as UserInterface;
use App\Mail\registration;
use Mail;

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

        $remember = (Input::has('remember')) ? true : false;

        if(Auth::attempt(['email' => request('email'), 'password' => request('password')],$remember)){

            $user = Auth::user();
            if($user["verification_code"] != null){
               return response()->json(['error'=>'User not yet verified.'], 401); 
            }else{
                $success['token'] =  $user->createToken('MyApp')->accessToken;
                return response()->json(['success' => $success], 200);
            }
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
        $data["verification_code"] = rand(1000,9999);
        $user = $this->user->insert($data);
        Mail::to($data["email"])->send(new registration($user));
        return response()->json(['success'=> $user]);

    }


    /**
     * verify account api
     *
     * @return \Illuminate\Http\Response
     */

    public function verify(verificationRequest $request)
    {
        $data = Input::all();
        $user = $this->user->findByEmail($data["email"]);

        if(!$user){
            return response()->json(['error'=>'Unauthorised'], 401);
        }else{
            if($user["verification_code"] != $data["verification_code"]){

               return  response()->json(['error'=>'Verification code does not match, Please check if you have registered or maybe your account is already verified.'],401);
            }else{
                $update["id"] = $user["id"];
                $update["verification_code"] = null;
                $this->user->update($update);
                return response()->json(['success'=>"successfully verified account."]);
            }
        }   
    }


    /**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function details()
    {  
       $user = Auth::user();
        return response()->json(['success' => $user], 200);
    }


    /**
     * logout api
     *
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {  
       $request->user()->token()->revoke();
       $request->user()->token()->delete(); 
       return response()->json(['success' => "user successfully logout."], 200);
    }


}
