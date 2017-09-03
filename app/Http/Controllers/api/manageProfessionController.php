<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Profession\professionInterface as professionInterface;
use App\Http\Requests\manageProfessionRequest;
use Illuminate\Support\Facades\Input;

class manageProfessionController extends Controller
{   

    public function __construct(professionInterface $profession){
        $this->profession = $profession;
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

        $data = $this->profession->getAll($offset, $limit, $search);
        $data['offset'] = isset($_GET['all']) ? 'all' :$offset;
        $data['limit'] = isset($_GET['all']) ? 'all' : $limit;
        $data['total'] = 0;
        
        $data['total'] = $this->profession->count();

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
    public function store(manageProfessionRequest $request)
    {
        $data = Input::all();

        $profession = $this->profession->insert($data);

        if($profession){
            return response()->json(['success'=> $profession ], 200);
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
        $profession = $this->profession->find($id);

        if($profession){
            return response()->json(['success'=>$profession], 200);
        }else{
            return response()->json(['error'=>'Profession not found'], 401);
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
    public function update(manageProfessionRequest $request, $id)
    {
        $data = Input::all();
        $profession = $this->profession->find($id);
        $data['id'] = $id;

        if($profession){

            $update = $this->profession->update($data);

            if(!$update){
               return response()->json(['error'=>'Server error'],500); 
            }else{
                $profession = $this->profession->find($id);
                return response()->json(['success'=>$profession],200);
            }



        }else{
            return response()->json(['error'=>'Profession not found'], 401);
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
        $profession = $this->profession->find($id);

        if($profession){
            $deleted = $this->profession->delete($id);

            if($deleted){
                return response()->json(['success'=>'successfully deleted Profession.'],200);
            }else{
                return response()->json(['error'=>'Server error'],500);
            }
        }else{
            return response()->json(['error'=>'Profession not found'], 401);
        }
    }
}
