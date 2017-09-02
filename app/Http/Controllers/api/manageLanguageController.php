<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use App\Repositories\Language\languageInterface as languageInterface;
use App\Http\Requests\manageLanguageRequest;

class manageLanguageController extends Controller
{   

    public function __construct(languageInterface $language){
        $this->language = $language;
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

        $data = $this->language->getAll($offset, $limit, $search);
        $data['offset'] = isset($_GET['all']) ? 'all' :$offset;
        $data['limit'] = isset($_GET['all']) ? 'all' : $limit;
        $data['total'] = 0;
        
        $data['total'] = $this->language->count();

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
    public function store(manageLanguageRequest $request)
    {
        $data = Input::all();

        $language = $this->language->insert($data);

        if($language){
            return response()->json(['success'=> $language ], 200);
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
       $language = $this->language->find($id);

        if($language){
            return response()->json(['success'=>$language], 200);
        }else{
            return response()->json(['error'=>'Language not found'], 401);
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
    public function update(manageLanguageRequest $request, $id)
    {
        $data = Input::all();
        $language = $this->language->find($id);
        $data['id'] = $id;

        if($language){

            $update = $this->language->update($data);

            if(!$update){
               return response()->json(['error'=>'Server error'],500); 
            }else{
                $language = $this->language->find($id);
                return response()->json(['success'=>$language],200);
            }

        }else{
            return response()->json(['error'=>'Language not found'], 401);
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
        $language = $this->language->find($id);

        if($language){
            $deleted = $this->language->delete($id);

            if($deleted){
                return response()->json(['success'=>'successfully deleted user.'],200);
            }else{
                return response()->json(['error'=>'Server error'],500);
            }
        }else{
            return response()->json(['error'=>'Language not found'], 401);
        }
    }
}
