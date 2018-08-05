<?php
namespace App\Repositories\Duration;

use App\Repositories\Duration\durationInterface as durationInterface;
use App\Duration;

class durationRepository implements durationInterface
{
    public $activity;

    function __construct(Duration $duration) {
	$this->duration = $duration;
    }

    public function getAll($offset, $limit, $search)
    {
        return $this->duration->getAll($offset, $limit, $search);
    }

    public function find($id)
    {
        return $this->duration->findDuration($id);
    }

    public function insert($data)
    {
        return $this->duration->insertDuration($data);
    }

    public function delete($id)
    {
        return $this->duration->deleteDuration($id);
    }

    public function update($data)
    {
        return $this->duration->updateDuration($data);
    }

    public function count(){
        return $this->duration->countDuration();
    }
}