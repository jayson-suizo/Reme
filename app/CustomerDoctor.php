<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class CustomerDoctor extends Model
{
    protected $table = 'customer_doctor';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'customer_id', 'doctor_id'
    ];


     public function getAll($offset = 0, $limit = 10, $search = [])
    {   

        $customer_doctor =  new static;

        if(isset($search["all"])){
            return $customer_doctor->get();
        }else{
             if(isset($search['name'])){
                $customer_doctor = $customer_doctor->where('name','like', '%'.$search['name'].'%');
            }

            $customer_doctor = $customer_doctor->offset($offset)->limit($limit);
            return $customer_doctor->get();
        }
    }

    public function findCustomerDoctor($id)
    {	
        return static::find($id);
    }

     public function InsertCustomerDoctor($data)
    {
        return static::create($data);
    }

    public function deleteCustomerDoctor($id)
    {
        return static::find($id)->delete();
    }

   
    public function updateCustomerDoctor($data)
    {
        return static::find($data['id'])->update($data);
    }

    public function getAllByDoctorId($doctor_id) {
        return static::where("doctor_id",$doctor_id)->get();
    }

    public function countCustomerDoctor(){
        return static::count();
    }
}
