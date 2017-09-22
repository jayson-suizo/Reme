<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Answer\answerInterface as answerInterface;
use App\Http\Requests\manageAnswerRequest;
use Illuminate\Support\Facades\Input;

class manageAnswerController extends Controller
{   

    public function __construct(answerInterface $answer){
        $this->answer = $answer;
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
        
        if(isset($_GET['question_id'])){
            $search['question_id'] = $_GET['question_id'];
        }

        $data = $this->answer->getAll($offset, $limit, $search);
        $data['offset'] = isset($_GET['question_id']) ? 'all' :$offset;
        $data['limit'] = isset($_GET['question_id']) ? 'all' : $limit;
        $data['total'] = 0;
        
        $data['total'] = $this->answer->count();

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
    public function store(manageAnswerRequest $request)
    {
        $data = Input::all();

         $answer = $this->answer->insert($data);

        if($answer){
            return response()->json(['success'=> $answer ], 200);
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
         $answer = $this->answer->find($id);

        if($answer){
            return response()->json(['success'=>$answer], 200);
        }else{
            return response()->json(['error'=>'Answer not found'], 401);
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
    public function update(manageAnswerRequest $request, $id)
    {
        $data = Input::all();
        $answer = $this->answer->find($id);
        $data['id'] = $id;

        if($answer){

            $update = $this->answer->update($data);

            if(!$update){
               return response()->json(['error'=>'Server error'],500); 
            }else{
                $answer = $this->answer->find($id);
                return response()->json(['success'=>$answer],200);
            }



        }else{
            return response()->json(['error'=>'Answer not found'], 401);
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
        $answer = $this->answer->find($id);

        if($answer){
            $deleted = $this->answer->delete($id);

            if($deleted){
                return response()->json(['success'=>'successfully deleted answer.'],200);
            }else{
                return response()->json(['error'=>'Server error'],500);
            }
        }else{
            return response()->json(['error'=>'Answer not found'], 401);
        }
    }
}
