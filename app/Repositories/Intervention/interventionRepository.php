<?php
namespace App\Repositories\Intervention;

use App\Repositories\intervention\interventionInterface as interventionInterface;
use App\Intervention;

class interventionRepository implements interventionInterface
{
    public $intervention;

    function __construct(Intervention $intervention) {
	$this->intervention = $intervention;
    }

    public function getAll($offset, $limit, $search)
    {
        return $this->intervention->getAll($offset, $limit, $search);
    }

    public function find($id)
    {
        return $this->intervention->findIntervention($id);
    }

    public function insert($data)
    {
        return $this->intervention->insertIntervention($data);
    }

    public function delete($id)
    {
        return $this->intervention->deleteIntervention($id);
    }

    public function update($data)
    {
        return $this->intervention->updateIntervention($data);
    }

    public function count(){
        return $this->intervention->countIntervention();
    }
}