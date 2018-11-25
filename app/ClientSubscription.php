<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ClientSubscription extends Model
{
    protected $table = 'client_subscription';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'client_id','purchased_date','date_expired','status'
    ];

    public function  user() {
        return $this->hasOne('App\User','id','client_id');
    }



     public function getAll($offset = 0, $limit = 10, $search = [])
    {   

        $client_subscription =  new static;

        if(isset($search["all"])){
            return $client_subscription->with('user')->get();
        }else{

             if(isset($search['name'])){
                $client_subscription = $client_subscription->where('name','like', '%'.$search['name'].'%');
            }

            $client_subscription = $client_subscription->with('user')->offset($offset)->limit($limit);
            return $client_subscription->get();
        }
    }

    public function findClientSubscription($id)
    {	
        return static::find($id);
    }

     public function InsertClientSubscription($data)
    {
        return static::create($data);
    }

    public function deleteClientSubscription($id)
    {
        return static::find($id)->delete();
    }

   
    public function updateClientSubscription($data)
    {
        return static::find($data['id'])->update($data);
    }

    public function countClientSubscription(){
        return static::count();
    }

    public function getSubscription($code) {
         return static::where("code",$code)->with('user')->first();
    }

    public function updateSubscription($data) {
         return static::where("code",$data["code"])->update($data);
    }
}
