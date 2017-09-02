<?php
namespace App\Repositories\Activity;

use App\Repositories\Activity\activityInterface as activityInterface;
use App\Activity;

class activityRepository implements activityInterface
{
    public $activity;

    function __construct(Activity $activity) {
	$this->user = $activity;
    }

    // public function getAll($offset, $limit, $search)
    // {
    //     return $this->user->getAll($offset, $limit, $search);
    // }

    // public function find($id)
    // {
    //     return $this->user->findUser($id);
    // }

    // public function insert($data)
    // {
    //     return $this->user->insertUser($data);
    // }

    // public function delete($id)
    // {
    //     return $this->user->deleteUser($id);
    // }

    // public function findByEmail($email)
    // {
    //     return $this->user->findByEmailUser($email);
    // }

    // public function findByNewEmail($new_email){

    //     return $this->user->findByNewEmailUser($new_email);
    // }

    // public function update($data)
    // {
    //     return $this->user->updateUser($data);
    // }

    // public function count(){
    //     return $this->user->countUser();
    // }
}