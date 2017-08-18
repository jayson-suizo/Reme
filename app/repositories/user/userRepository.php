<?php
namespace App\Repositories\User;

use App\Repositories\User\userInterface as userInterface;
use App\User;

class UserRepository implements userInterface
{
    public $user;

    function __construct(User $user) {
	$this->user = $user;
    }

    public function getAll()
    {	return 1;
    	die;
        return $this->user->getAll();
    }

    public function find($id)
    {
        return $this->user->findUser($id);
    }

    public function insert($data)
    {
        return $this->user->insertUser($data);
    }

    public function delete($id)
    {
        return $this->user->deleteUser($id);
    }
}