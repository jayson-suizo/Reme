<?php
namespace App\Repositories\Activity;

use App\Repositories\Activity\activityInterface as activityInterface;
use App\Activity;

class activityRepository implements activityInterface
{
    public $activity;

    function __construct(Activity $activity) {
	$this->activity = $activity;
    }

    public function getAll($offset, $limit, $search)
    {
        return $this->activity->getAll($offset, $limit, $search);
    }

    public function find($id)
    {
        return $this->activity->findActivity($id);
    }

    public function insert($data)
    {
        return $this->activity->insertActivity($data);
    }

    public function delete($id)
    {
        return $this->activity->deleteActivity($id);
    }

    public function update($data)
    {
        return $this->activity->updateActivity($data);
    }

    public function count(){
        return $this->activity->countActivity();
    }
}