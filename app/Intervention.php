<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Intervention extends Model
{
     protected $table = 'intervention';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name'
    ];



     public function getAll($offset = 0, $limit = 10, $search = [])
    {   

        $intervention =  new static;

        if(isset($search["all"])){
            return $intervention->get();
        }else{
             if(isset($search['name'])){
                $intervention = $intervention->where('name','like', '%'.$search['name'].'%');
            }

            $intervention = $intervention->offset($offset)->limit($limit);
            return $intervention->get();
        }
    }

    public function findIntervention($id)
    {	
        return static::find($id);
    }

     public function InsertIntervention($data)
    {
        return static::create($data);
    }

    public function deleteIntervention($id)
    {
        return static::find($id)->delete();
    }

   
    public function updateIntervention($data)
    {
        return static::find($data['id'])->update($data);
    }

    public function countIntervention(){
        return static::count();
    }
}
