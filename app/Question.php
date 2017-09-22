<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'question'
    ];



     public function getAll($offset = 0, $limit = 10, $search = [])
    {   

        $question =  new static;

        if(isset($search["all"])){
            return $question->get();
        }else{
           
            $question = $question->offset($offset)->limit($limit);
            return $question->get();
        }
    }

    public function findQuestion($id)
    {	
        return static::find($id);
    }

     public function InsertQuestion($data)
    {
        return static::create($data);
    }

    public function deleteQuestion($id)
    {
        return static::find($id)->delete();
    }

   
    public function updateQuestion($data)
    {
        return static::find($data['id'])->update($data);
    }

    public function countQuestion(){
        return static::count();
    }
}
