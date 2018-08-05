<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Duration extends Model
{
     protected $table = 'duration';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'description'
    ];



     public function getAll($offset = 0, $limit = 10, $search = [])
    {   

        $duration =  new static;

        if(isset($search["all"])){
            return $duration->get();
        }else{
             if(isset($search['name'])){
                $duration = $duration->where('name','like', '%'.$search['name'].'%');
            }

            $duration = $duration->offset($offset)->limit($limit);
            return $duration->get();
        }
    }

    public function findDuration($id)
    {	
        return static::find($id);
    }

     public function InsertDuration($data)
    {
        return static::create($data);
    }

    public function deleteDuration($id)
    {
        return static::find($id)->delete();
    }

   
    public function updateDuration($data)
    {
        return static::find($data['id'])->update($data);
    }

    public function countDUration(){
        return static::count();
    }

}
