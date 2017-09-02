<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'user_activities';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'intervention_type','session_date','rate_before','rate_after','comment','professional_comment'
    ];



     public function getAll($offset = 0, $limit = 10, $search = [])
    {   

        $activity =  new static;

        if(isset($search["all"])){
            return $activity->get();
        }else{
             if(isset($search['name'])){
                $activity = $activity->where('name','like', '%'.$search['name'].'%');
            }

            $activity = $activity->offset($offset)->limit($limit);
            return $activity->get();
        }
    }

    public function findActivity($id)
    {	
        return static::find($id);
    }

     public function InsertActivity($data)
    {
        return static::create($data);
    }

    public function deleteActivity($id)
    {
        return static::find($id)->delete();
    }

   
    public function updateActivity($data)
    {
        return static::find($data['id'])->update($data);
    }

    public function countActivity(){
        return static::count();
    }

    
}
