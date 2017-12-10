<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\UserSubscription\userSubscriptionInterface as userSubscriptionInterface;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\manageUserSubscriptionRequest;

class manageUserSubscriptionController extends Controller
{   

    public function __construct(userSubscriptionInterface $user_subscription){
        $this->user_subscription = $user_subscription;
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

        if(isset($_GET['user_id'])){
            $search['user_id'] = $_GET['user_id'];
        }

        $data = $this->user_subscription->getAll($offset, $limit, $search);
        $data['offset'] = isset($_GET['all']) ? 'all' :$offset;
        $data['limit'] = isset($_GET['all']) ? 'all' : $limit;
        $data['total'] = 0;
        
        $data['total'] = $this->user_subscription->count();

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
    public function store(manageUserSubscriptionRequest $request)
    {
        $data = Input::all();

         $user_subscription = $this->user_subscription->insert($data);

        if($user_subscription){
            return response()->json(['success'=> $user_subscription ], 200);
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
         $user_subscription = $this->user_subscription->find($id);

         if($user_subscription){
            return response()->json(['success'=>$user_subscription], 200);
        }else{
            return response()->json(['error'=>'user subscription not found'], 401);
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
    public function update(manageUserSubscriptionRequest $request, $id)
    {
        $data = Input::all();
        $user_subscription = $this->user_subscription->find($id);
        $data['id'] = $id;

        if($user_subscription){

            $update = $this->user_subscription->update($data);

            if(!$update){
               return response()->json(['error'=>'Server error'],500); 
            }else{
                $user_subscription = $this->user_subscription->find($id);
                return response()->json(['success'=>$user_subscription],200);
            }

        }else{
            return response()->json(['error'=>'user subscription not found'], 401);
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
        $user_subscription = $this->user_subscription->find($id);

        if($user_subscription){
            $deleted = $this->user_subscription->delete($id);

            if($deleted){
                return response()->json(['success'=>'successfully deleted user subscription.'],200);
            }else{
                return response()->json(['error'=>'Server error'],500);
            }
        }else{
            return response()->json(['error'=>'user subscription not found'], 401);
        }
    }
}
