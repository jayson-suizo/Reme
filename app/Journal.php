<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    protected $table = 'journals';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'client_id','selected_session','mood_before','mood_after','comment'
    ];

    public function user() {
        return $this->hasOne('App\User','id','client_id');
    }

    public function customerDoctor() {
        return $this->hasOne('App\CustomerDoctor','customer_id','client_id');
    }

    public function session() {
        return $this->hasOne('App\Duration','id','selected_session');
    }



     public function getAll($offset = 0, $limit = 10, $search = [])
    {   

        $journal =  new static;

        if(isset($search["all"])){
            if(isset($search['client_id'])){
                $journal = $journal->where("client_id",$search["client_id"]);
            }
            return $journal->with("user")->with("customerDoctor")->get();
        }else{
            if(isset($search['client_id'])){
                $journal = $journal->where("client_id",$search["client_id"]);
            }

            $journal = $journal->offset($offset)->limit($limit);
            return $journal->with("user")->with("customerDoctor")->get();
        }
    }

    public function findJournal($id)
    {	
        return static::find($id);
    }

     public function InsertJournal($data)
    {
        return static::create($data);
    }

    public function deleteJournal($id)
    {
        return static::find($id)->delete();
    }

   
    public function updateJournal($data)
    {
        return static::find($data['id'])->update($data);
    }

    public function countJournal(){
        return static::count();
    }
}
