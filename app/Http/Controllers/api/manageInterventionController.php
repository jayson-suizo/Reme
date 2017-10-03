<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Intervention\interventionInterface as interventionInterface;
use App\Http\Requests\manageInterventionRequest;
use Illuminate\Support\Facades\Input;


class manageInterventionController extends Controller
{   
    public function __construct(interventionInterface $intervention){
        $this->intervention = $intervention;
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

        $data = $this->intervention->getAll($offset, $limit, $search);
        $data['offset'] = isset($_GET['all']) ? 'all' :$offset;
        $data['limit'] = isset($_GET['all']) ? 'all' : $limit;
        $data['total'] = 0;
        
        $data['total'] = $this->intervention->count();

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
    public function store(manageInterventionRequest $request)
    {
        $data = Input::all();

         $intervention = $this->intervention->insert($data);

        if($intervention){
            return response()->json(['success'=> $intervention ], 200);
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
         $intervention = $this->intervention->find($id);

        if($intervention){
            return response()->json(['success'=>$intervention], 200);
        }else{
            return response()->json(['error'=>'Intervention not found'], 401);
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
    public function update(manageInterventionRequest $request, $id)
    {
        $data = Input::all();
        $intervention = $this->intervention->find($id);
        $data['id'] = $id;

        if($intervention){

            $update = $this->intervention->update($data);

            if(!$update){
               return response()->json(['error'=>'Server error'],500); 
            }else{
                $intervention = $this->intervention->find($id);
                return response()->json(['success'=>$intervention],200);
            }



        }else{
            return response()->json(['error'=>'Intervention not found'], 401);
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
         $intervention = $this->intervention->find($id);

        if($intervention){
            $deleted = $this->intervention->delete($id);

            if($deleted){
                return response()->json(['success'=>'successfully deleted intervention.'],200);
            }else{
                return response()->json(['error'=>'Server error'],500);
            }
        }else{
            return response()->json(['error'=>'Intervention not found'], 401);
        }
    }
}
