<?php
namespace App\Repositories\Group;

use App\Repositories\Group\groupInterface as groupInterface;
use App\Group;

class groupRepository implements groupInterface
{
    public $group;

    function __construct(group $group) {
	   $this->group = $group;
    }

    public function getAll($offset, $limit, $search)
    {
        return $this->group->getAll($offset, $limit, $search);
    }

    public function find($id)
    {
        return $this->group->findGroup($id);
    }

    public function insert($data)
    {
        return $this->group->insertGroup($data);
    }

    public function delete($id)
    {
        return $this->group->deleteGroup($id);
    }

    public function update($data)
    {
        return $this->group->updateGroup($data);
    }

    public function count(){
        return $this->group->countGroup();
    }
}