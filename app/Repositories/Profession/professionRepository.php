<?php
namespace App\Repositories\Profession;

use App\Repositories\Profession\professionInterface as professionInterface;
use App\Profession;

class professionRepository implements professionInterface
{
    public $profession;

    function __construct(Profession $profession) {
	   $this->profession = $profession;
    }

    public function getAll($offset, $limit, $search)
    {
        return $this->profession->getAll($offset, $limit, $search);
    }

    public function find($id)
    {
        return $this->profession->findProfession($id);
    }

    public function insert($data)
    {
        return $this->profession->insertProfession($data);
    }

    public function delete($id)
    {
        return $this->profession->deleteProfession($id);
    }

    public function update($data)
    {
        return $this->profession->updateProfession($data);
    }

    public function count(){
        return $this->profession->countProfession();
    }
}