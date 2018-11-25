<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ClientSubscription\ClientSubscriptionInterface as ClientSubscriptionInterface;
use App\Http\Requests\manageClientSubscriptionRequest;
use Illuminate\Support\Facades\Input;
use Carbon\Carbon;

class manageClientSubscriptionController extends Controller
{   

    public function __construct(ClientSubscriptionInterface $client_subscription){
        $this->client_subscription = $client_subscription;
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

        //if(isset($_GET['all'])){
            $search['all'] = true;
        //}
        
        // if(isset($_GET['name'])){
        //     $search['name'] = $_GET['name'];
        // }

        $data = $this->client_subscription->getAll($offset, $limit, $search);
        $data['offset'] = isset($_GET['all']) ? 'all' :$offset;
        $data['limit'] = isset($_GET['all']) ? 'all' : $limit;
        $data['total'] = 0;
        
        $data['total'] = $this->client_subscription->count();

        return response()->json(['success'=> $data ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(manageClientSubscriptionRequest $request)
    {   
        $data = Input::all();

        $data["purchased_date"] = Carbon::now();
        $data["date_expired"] = Carbon::now()->addMonths(6);
        $data["status"] = "active";
        $data["code"] = $this->randomCode();
        $data["status"] = "active";

        $client_subscription = $this->client_subscription->insert($data);

        if($client_subscription){
            return response()->json(['success'=> $client_subscription ], 200);
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
        $client_subscription = $this->client_subscription->find($id);

        if($client_subscription){
            return response()->json(['success'=>$client_subscription], 200);
        }else{
            return response()->json(['error'=>'Client Subscription not found'], 401);
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
    public function update(manageClientSubscriptionRequest $request, $id)
    {
        $data = Input::all();

        $client_subscription = $this->client_subscription->getSubscription($data["code"]);
        $data["purchased_date"] = Carbon::now();
        $data["date_expired"] = Carbon::now()->addMonths(6);
        $data["status"] = "active";

        if($client_subscription){

            $update = $this->client_subscription->updateSubscription($data);

            if(!$update){
               return response()->json(['error'=>'Server error'],500); 
            }else{
                $client_subscription = $this->client_subscription->getSubscription($data["code"]);
                return response()->json(['success'=>$client_subscription],200);
            }



        }else{
            return response()->json(['error'=>'Client Subscription not found'], 401);
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
        $client_subscription = $this->client_subscription->find($id);

        if($client_subscription){
            $deleted = $this->client_subscription->delete($id);

            if($deleted){
                return response()->json(['success'=>'successfully deleted Client Subscription.'],200);
            }else{
                return response()->json(['error'=>'Server error'],500);
            }
        }else{
            return response()->json(['error'=>'Client Subscription not found'], 401);
        }
    }


    public function subscription($code){
        $date_now = Carbon::now();

        $client_subscription =  $this->client_subscription->getSubscription($code);
    
        if($client_subscription && $client_subscription["user"] != null) {
           $date_expired = $client_subscription->date_expired;
           if($date_now < $date_expired) {
                return response()->json(['success'=> $client_subscription ], 200);
           } else {
                return response()->json(['error'=>'Expired Subscription'], 200);
           }
           

        } else {
            return response()->json(['error'=>'Client Subscription not found'], 401);
        }
    }


    function randomCode() {
      $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
      
      $already_taken = true;
      $max = strlen($characters) - 1;

      do {
        $randomString = '';
        $max = strlen($characters) - 1;
        for ($i = 0; $i < 6; $i++) {
          $randomString .= $characters[mt_rand(0, $max)];
        }

        $check_sub = $this->client_subscription->getSubscription($randomString);

        if(!$check_sub) {
          $already_taken = false;
        }

      } while ($already_taken);

     

      return $randomString;
    } 
}
