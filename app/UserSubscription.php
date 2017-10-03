<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class userSubscription extends Model
{   
    protected $table = 'user_subscription';

     /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'subscription_id'
    ];

    public function user()
    {   
        return $this->belongsTo('App\User','user_id','id');
    }


    public function subscription(){
        return $this->belongsTo('App\Subscription','subscription_id','id');
    }

     public function getAll($offset = 0, $limit = 10, $search = [])
    {   
        $user_subscription =  new static;

        if(isset($search["all"])){
            return $user_subscription->get();
        }else{
            if(isset($search['user_id'])){
                
                $user_subscription = $user_subscription->where('user_id',$search['user_id']);
            }
            if(isset($search['subscription'])){
                $subscription = $search["subscription"];
                $user_subscription = $user_subscription->whereHas('subscription',function ($q) use ($subscription){
                       $q->where('name', $subscription);
                });
            }

            $user_subscription = $user_subscription->with('user')->with('subscription')->offset($offset)->limit($limit);
            return $user_subscription->get();
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
