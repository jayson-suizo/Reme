<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserType extends Model
{
    protected $table = 'user_types';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'type'
    ];



     public function getAll($offset = 0, $limit = 10, $search = [])
    {   

        $user_type =  new static;

        if(isset($search["all"])){
            return $user_type->get();
        }else{
           
            $user_type = $user_type->offset($offset)->limit($limit);
            return $user_type->get();
        }
    }

    public function findUserType($id)
    {	
        return static::find($id);
    }

     public function InsertUserType($data)
    {
        return static::create($data);
    }

    public function deleteUserType($id)
    {
        return static::find($id)->delete();
    }

   
    public function updateUserType($data)
    {
        return static::find($data['id'])->update($data);
    }

    public function countUserType(){
        return static::count();
    }
}
