<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'user_activities';


    //  public function getAll($offset = 0, $limit = 10, $search = [])
    // {   

    //     $user =  new static;

    //     if(isset($search['name'])){
    //         $user = $user->where('name','like', '%'.$search['name'].'%');
    //     }

    //     $user = $user->offset($offset)->limit($limit);
    //     return $user->get();
    // }

    public function findActivity($id)
    {	
        return static::find($id);
    }

    //  public function InsertUser($data)
    // {
    //     return static::create($data);
    // }

    // public function deleteUser($id)
    // {
    //     return static::find($id)->delete();
    // }

    // public function findByEmailUser($email)
    // {
    //     return static::where("email",$email)->first();
    // }

    // public function findByNewEmailUser($new_email)
    // {
    //     return static::where("new_email",$new_email)->first();
    // }

    // public function updateUser($data)
    // {
    //     return static::find($data['id'])->update($data);
    // }

    // public function countUser(){
    //     return static::count();
    // }

    
}
