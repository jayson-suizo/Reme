<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Question\questionInterface as questionInterface;
use App\Http\Requests\manageQuestionRequest;
use Illuminate\Support\Facades\Input;

class manageQuestionController extends Controller
{   

    public function __construct(questionInterface $question){
        $this->question = $question;
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

        $data = $this->question->getAll($offset, $limit, $search);
        $data['offset'] = isset($_GET['all']) ? 'all' :$offset;
        $data['limit'] = isset($_GET['all']) ? 'all' : $limit;
        $data['total'] = 0;
        
        $data['total'] = $this->question->count();

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
    public function store(manageQuestionRequest $request)
    {
        $data = Input::all();

         $question = $this->question->insert($data);

        if($question){
            return response()->json(['success'=> $question ], 200);
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
        $question = $this->question->find($id);

        if($question){
            return response()->json(['success'=>$question], 200);
        }else{
            return response()->json(['error'=>'Question not found'], 401);
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
    public function update(manageQuestionRequest $request, $id)
    {
        $data = Input::all();
        $question = $this->question->find($id);
        $data['id'] = $id;

        if($question){

            $update = $this->question->update($data);

            if(!$update){
               return response()->json(['error'=>'Server error'],500); 
            }else{
                $question = $this->question->find($id);
                return response()->json(['success'=>$question],200);
            }



        }else{
            return response()->json(['error'=>'Question not found'], 401);
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
         $question = $this->question->find($id);

        if($question){
            $deleted = $this->question->delete($id);

            if($deleted){
                return response()->json(['success'=>'successfully deleted question.'],200);
            }else{
                return response()->json(['error'=>'Server error'],500);
            }
        }else{
            return response()->json(['error'=>'Question not found'], 401);
        }
    }
}
