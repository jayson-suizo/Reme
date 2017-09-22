<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserLanguage extends Model
{
    protected $table = 'user_languages';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'language_id'
    ];



     public function getAll($offset = 0, $limit = 10, $search = [])
    {   

        $user_language =  new static;

        if(isset($search["all"])){
            return $user_language->get();
        }else{
             if(isset($search['user_id'])){
                $user_language = $user_language->where('user_id',$search['user_id']);
            }

            $user_language = $user_language->offset($offset)->limit($limit);
            return $user_language->get();
        }
    }

    public function findUserLanguage($id)
    {	
        return static::find($id);
    }

     public function InsertUserLanguage($data)
    {
        return static::create($data);
    }

    public function deleteUserLanguage($id)
    {
        return static::find($id)->delete();
    }

   
    public function updateUserLanguage($data)
    {
        return static::find($data['id'])->update($data);
    }

    public function countUserLanguage(){
        return static::count();
    }
}
