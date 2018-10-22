<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Audio extends Model
{
    protected $table = 'audio';

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'url','selected_session','language_id','status'
    ];

    public function  session() {
        return $this->hasOne('App\Duration','id','selected_session');
    }

    public function  language() {
        return $this->hasOne('App\language','id','language_id');
    }



     public function getAll($offset = 0, $limit = 10, $search = [])
    {   

        $audio =  new static;

        if(isset($search["all"])){

            if(isset($search["selected_session"])) {
                $audio = $audio->where("selected_session",$search["selected_session"]);
            }
            return $audio->with('session','language')->get();
        }else{
             if(isset($search['name'])){
                $audio = $audio->where('name','like', '%'.$search['name'].'%');
            }

            $audio = $audio->offset($offset)->limit($limit);
            return $audio->get();
        }
    }

    public function findAudio($id)
    {	
        return static::find($id);
    }

     public function InsertAudio($data)
    {
        return static::create($data);
    }

    public function deleteAudio($id)
    {
        return static::find($id)->delete();
    }

   
    public function updateAudio($data)
    {
        return static::find($data['id'])->update($data);
    }

    public function countAudio(){
        return static::count();
    }


    public function lastId() {
        return static::select('id')->orderBy("id","desc")->first();
    }

    
}
