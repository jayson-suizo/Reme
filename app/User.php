<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','first_name','last_name','user_type','gender',
        'age','profession_type','group_type','role','verification_code','new_email',
        'email_verification_code','new_password','password_verification_code',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token','verification_code'
    ];


    public function getAll()
    {
        return static::all();
    }

    public function findUser($id)
    {
        return static::find($id);
    }

     public function InsertUser($data)
    {
        return static::create($data);
    }

    public function deleteUser($id)
    {
        return static::find($id)->delete();
    }

    public function findByEmailUser($email)
    {
        return static::where("email",$email)->first();
    }

    public function updateUser($data)
    {
        return static::find($data['id'])->update($data);
    }
}
