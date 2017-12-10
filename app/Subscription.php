<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class subscription extends Model
{
    protected $table = 'subscription';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'period'
    ];



     public function getAll($offset = 0, $limit = 10, $search = [])
    {   

        $subscription =  new static;

        if(isset($search["all"])){
            return $subscription->get();
        }else{
            $subscription = $subscription->offset($offset)->limit($limit);
            return $subscription->get();
        }
    }

    public function findSubscription($id)
    {	
        return static::find($id);
    }

     public function InsertSubscription($data)
    {
        return static::create($data);
    }

    public function deleteSubscription($id)
    {
        return static::find($id)->delete();
    }

    public function updateSubscription($data)
    {
        return static::find($data['id'])->update($data);
    }

    public function countSubscription(){
        return static::count();
    }

}
