<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Profession extends Model
{
    protected $table = 'profession';

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

        $profession =  new static;

        if(isset($search["all"])){
            return $profession->get();
        }else{
             if(isset($search['name'])){
                $profession = $profession->where('name','like', '%'.$search['name'].'%');
            }

            $profession = $profession->offset($offset)->limit($limit);
            return $profession->get();
        }
    }

    public function findProfession($id)
    {	
        return static::find($id);
    }

    public function InsertProfession($data)
    {
        return static::create($data);
    }

    public function deleteProfession($id)
    {
        return static::find($id)->delete();
    }

   
    public function updateProfession($data)
    {
        return static::find($data['id'])->update($data);
    }

    public function countProfession(){
        return static::count();
    }
}
