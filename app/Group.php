<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
     protected $table = 'group';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','user_id' 
    ];


    public function getAll($offset = 0, $limit = 10, $search = [])
    {   

        $group =  new static;

        if(isset($search["all"])){
            return $group->get();
        }else{
             if(isset($search['name'])){
                $group = $group->where('name','like', '%'.$search['name'].'%');
            }

            $group = $group->offset($offset)->limit($limit);
            return $group->get();
        }
    }

    public function findGroup($id)
    {	
        return static::find($id);
    }

    public function InsertGroup($data)
    {
        return static::create($data);
    }

    public function deleteGroup($id)
    {
        return static::find($id)->delete();
    }

   
    public function updateGroup($data)
    {
        return static::find($data['id'])->update($data);
    }

    public function countGroup(){
        return static::count();
    }
}
