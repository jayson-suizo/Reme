<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\subscription\userubscriptionInterface as subscriptionInterface;
use Illuminate\Support\Facades\Input;
use App\Http\Requests\manageSubscriptionRequest;

class manageSubscriptionController extends Controller
{   

    public function __construct(subscriptionInterface $subscription){
        $this->subscription = $subscription;
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

        $data = $this->subscription->getAll($offset, $limit, $search);
        $data['offset'] = isset($_GET['all']) ? 'all' :$offset;
        $data['limit'] = isset($_GET['all']) ? 'all' : $limit;
        $data['total'] = 0;
        
        $data['total'] = $this->subscription->count();

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
    public function store(manageSubscriptionRequest $request)
    {
         $data = Input::all();

         $subscription = $this->subscription->insert($data);

        if($subscription){
            return response()->json(['success'=> $subscription ], 200);
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
        $subscription = $this->subscription->find($id);

         if($subscription){
            return response()->json(['success'=>$subscription], 200);
        }else{
            return response()->json(['error'=>'subscription not found'], 401);
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
    public function update(manageSubscriptionRequest $request, $id)
    {
        $data = Input::all();
        $subscription = $this->subscription->find($id);
        $data['id'] = $id;

        if($subscription){

            $update = $this->subscription->update($data);

            if(!$update){
               return response()->json(['error'=>'Server error'],500); 
            }else{
                $subscription = $this->subscription->find($id);
                return response()->json(['success'=>$subscription],200);
            }

        }else{
            return response()->json(['error'=>'subscription not found'], 401);
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
         $subscription = $this->subscription->find($id);

        if($subscription){
            $deleted = $this->subscription->delete($id);

            if($deleted){
                return response()->json(['success'=>'successfully deleted user.'],200);
            }else{
                return response()->json(['error'=>'Server error'],500);
            }
        }else{
            return response()->json(['error'=>'subscription not found'], 401);
        }
    }
}
