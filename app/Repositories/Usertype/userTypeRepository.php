<?php
namespace App\Repositories\UserType;

use App\Repositories\UserType\userTypeInterface as userTypeInterface;
use App\UserType;

class userTypeRepository implements userTypeInterface
{
    public $user_type;

    function __construct(UserType $user_type) {
	$this->user_type = $user_type;
    }

    public function getAll($offset, $limit, $search)
    {
        return $this->user_type->getAll($offset, $limit, $search);
    }

    public function find($id)
    {
        return $this->user_type->findUserType($id);
    }

    public function insert($data)
    {
        return $this->user_type->insertUserType($data);
    }

    public function delete($id)
    {
        return $this->user_type->deleteUserType($id);
    }

    public function update($data)
    {
        return $this->user_type->updateUserType($data);
    }

    public function count(){
        return $this->user_type->countUserType();
    }
}