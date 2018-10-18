<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Language extends Model
{
    protected $table = 'languages';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'language', 'lang_code','status',
    ];


    public function getAll($offset = 0, $limit = 10, $search = [])
    {   

        $language =  new static;

        if(isset($search["all"])){
            return $language->get();
        }else{
             if(isset($search['name'])){
                $language = $language->where('name','like', '%'.$search['name'].'%');
            }

            $language = $language->offset($offset)->limit($limit);
            return $language->get();
        }
    }

    public function findLanguage($id)
    {	
        return static::find($id);
    }

    public function InsertLanguage($data)
    {
        return static::create($data);
    }

    public function deleteLanguage($id)
    {
        return static::find($id)->delete();
    }

   
    public function updateLanguage($data)
    {
        return static::find($data['id'])->update($data);
    }

    public function countLanguage(){
        return static::count();
    }

}
