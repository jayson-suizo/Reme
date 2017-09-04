<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
     protected $table = 'answers';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question_id','answer','correct_answer'
    ];



     public function getAll($offset = 0, $limit = 10, $search = [])
    {   

        $answer =  new static;

        if(isset($search["question_id"])){
            return $answer->where('question_id',$search['question_id'])->get();
        }else{
             if(isset($search['name'])){
                $answer = $answer->where('name','like', '%'.$search['name'].'%');
            }

            $answer = $answer->offset($offset)->limit($limit);
            return $answer->get();
        }
    }

    public function findAnswer($id)
    {	
        return static::find($id);
    }

     public function InsertAnswer($data)
    {
        return static::create($data);
    }

    public function deleteAnswer($id)
    {
        return static::find($id)->delete();
    }

   
    public function updateAnswer($data)
    {
        return static::find($data['id'])->update($data);
    }

    public function countAnswer(){
        return static::count();
    }
}
