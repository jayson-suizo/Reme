<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\CustomerDoctor\customerDoctorInterface as customerDoctorInterface;
use App\Http\Requests\manageCustomerDoctorRequest;
use Illuminate\Support\Facades\Input;

class manageCustomerDoctorController extends Controller
{   

    public function __construct(customerDoctorInterface $customer_doctor){
        $this->customer_doctor = $customer_doctor;
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
        
        // if(isset($_GET['name'])){
        //     $search['name'] = $_GET['name'];
        // }

        $data = $this->customer_doctor->getAll($offset, $limit, $search);
        $data['offset'] = isset($_GET['all']) ? 'all' :$offset;
        $data['limit'] = isset($_GET['all']) ? 'all' : $limit;
        $data['total'] = 0;
        
        $data['total'] = $this->customer_doctor->count();

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
    public function store(manageCustomerDoctorRequest $request)
    {
        $data = Input::all();

        $customer_doctor = $this->customer_doctor->insert($data);

        if($customer_doctor){
            return response()->json(['success'=> $customer_doctor ], 200);
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
        $customer_doctor = $this->customer_doctor->find($id);

        if($customer_doctor){
            return response()->json(['success'=>$customer_doctor], 200);
        }else{
            return response()->json(['error'=>'customernot found'], 401);
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
    public function update(manageCustomerDoctorRequest $request, $id)
    {   
        $data = Input::all();
        $customer_doctor = $this->customer_doctor->find($id);
        $data['id'] = $id;

        if($customer_doctor){

            $update = $this->customer_doctor->update($data);

            if(!$update){
               return response()->json(['error'=>'Server error'],500); 
            }else{
                $customer_doctor = $this->customer_doctor->find($id);
                return response()->json(['success'=>$customer_doctor],200);
            }



        }else{
            return response()->json(['error'=>'Customer not found'], 401);
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
        $customer_doctor = $this->customer_doctor->find($id);

        if($customer_doctor){
            $deleted = $this->customer_doctor->delete($id);

            if($deleted){
                return response()->json(['success'=>'successfully deleted user.'],200);
            }else{
                return response()->json(['error'=>'Server error'],500);
            }
        }else{
            return response()->json(['error'=>'Customer not found'], 401);
        }
    }
}
