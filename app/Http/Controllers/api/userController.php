<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\Auth;
use Validator;
use App\Http\Requests\userRegistrationRequest;
use App\Http\Requests\updateUserRegistrationRequest;
use App\Http\Requests\verifyUpdateEmailRequest;
use App\Http\Requests\updateUserEmailRequest;
use App\Http\Requests\verificationRequest;
use App\Http\Requests\changePasswordRequest;
use App\Http\Requests\confirmChangePasswordRequest;
use Illuminate\Support\Facades\Input;
use App\Repositories\User\userInterface as UserInterface;

use App\Mail\registration;
use App\Mail\updateEmail;
use App\Mail\changePassword;
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
        $next = $request->get('next');

        $data["name"] = $data["first_name"] .' '.$data["last_name"];
        $data["password"] = bcrypt($data["password"]);
        $data["verification_code"] = str_random(60);
        $user = $this->user->insert($data);
        Mail::to($data["email"])->send(new registration($user, $next));
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

    public function activate(Request $request, $token)
    {
      $user = $this->user->findByToken($token);
      $next = $request->get('next');
      if($user) {
        //activate
        $update["id"] = $user["id"];
        $update["verification_code"] = null;
        $this->user->update($update);
        
        return redirect()->to($next);
      } else {
        return redirect()->to($next . '?q=failed');
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
     * update details api
     *
     * @return \Illuminate\Http\Response
     */
    public function update(updateUserRegistrationRequest $request)
    {  

       $id = Auth::user()->id;
       $data = Input::all();
       $data["id"] = $id;
       $data["name"] = $data["first_name"]." ".$data["last_name"];
       $updated = $this->user->update($data);
       if($updated){

         $user = $this->user->find($id);
         return response()->json(['success' => $user], 200);

       }else{

         return response()->json(['error' => "server error."], 500);
       }
       
    }

     /**
     * update email api
     *
     * @return \Illuminate\Http\Response
     */
    public function updateEmail(updateUserEmailRequest $request)
    {  
       $id = Auth::user()->id; 
       $data = Input::all();
       $data["email_verification_code"] = rand(1000,9999);
       $data["id"] = $id;
       $updated = $this->user->update($data);

       if($updated){

         $user = $this->user->find($id);
         Mail::to($data["new_email"])->send(new updateEmail($user));
         return response()->json(['success' => $user], 200);

       }else{

         return response()->json(['error' => "server error."], 500);
       }
       
       
    }

    /**
     * update email api
     *
     * @return \Illuminate\Http\Response
     */
    public function verifyUpdateEmail(verifyUpdateEmailRequest $request)
    {  
       $data = Input::all();
       $user = $this->user->findByNewEmail($data["new_email"]);
       
       if(!$user){

         return response()->json(['error' => 'data not available.'], 500);

        }else{

             if($user["email_verification_code"] != $data["email_verification_code"]){

               return response()->json(['error' => 'verification code does not match.'], 500); 
             }

             $update_record['id'] = $user['id'];
             $update_record['new_email'] = NULL;
             $update_record['email_verification_code'] = NULL;
             $update_record['email'] = $data['new_email'];

             $updated = $this->user->update($update_record);

             if(!$updated){

                return response()->json(['error' => 'server error.'], 500); 
             }

             $user = $this->user->find($user['id']);

             return response()->json(['success' => $user], 200);

         
         
       }
    }


    /**
     * update change password api
     *
     * @return \Illuminate\Http\Response
     */
    public function changePassword(changePasswordRequest $request)
    {  
       
      $data = Input::all();
      $data["password_verification_code"] = rand(1000,9999);

      $user = $this->user->findByEmail($data['email']);

      if(!$user){
        
        return response()->json(['error' => 'data not available.'], 500);
      
      }else{

        $data['id'] = $user['id'];
        unset($data['email']);
        $updated = $this->user->update($data);

        if($updated){
           $user = $this->user->find($data['id']);

           Mail::to($user['email'])->send(new changePassword($user));
           return response()->json(['success' => $user], 200);

        }else{

            return response()->json(['error' => 'server error.'], 500);
        }

      }


    }

     /**
     * update change password api
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmChangePassword(confirmChangePasswordRequest $request)
    {  
       $data = Input::all();

       $user = $this->user->findByEmail($data["email"]);

       if(!$user){

         return response()->json(['error' => 'data not available.'], 500);
       
       }else{
         
         if($data['password_verification_code'] != $user['password_verification_code']){

            return response()->json(['error' => 'verification code does not match.'], 500);
        
         }else{
            $data['password'] = bcrypt($user["new_password"]);
            $data['id'] = $user['id'];
            $data['new_password'] = NULL;
            $data['password_verification_code'] = NULL;
            $updated = $this->user->update($data);
            return response()->json(['success' => $user], 200);
         }
       }




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



    public function archiveUser() {
     
      $data = Input::only("id", "archive");
      $user = $this->user->find($data["id"]);

      if(!$user) {
        
        return response()->json(['error' => 'data not available.'], 500);
      
      }else {
          $updated = $this->user->update($data);

          if(!$updated){

            return response()->json(['error' => 'server error.'], 500); 
          }else {
            return response()->json(['success' => "user successfully updated."], 200);
          }
      }
    }


}
