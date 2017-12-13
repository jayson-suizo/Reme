<?php
namespace App\Repositories\Subscription;

use App\Repositories\Subscription\subscriptionInterface as subscriptionInterface;
use App\Subscription;

class subscriptionRepository implements subscriptionInterface
{
    public $subscription;

    function __construct(Subscription $subscription) {
	   $this->subscription = $subscription;
    }

    public function getAll($offset, $limit, $search)
    {
        return $this->subscription->getAll($offset, $limit, $search);
    }

    public function find($id)
    {
        return $this->subscription->findSubscription($id);
    }

    public function insert($data)
    {
        return $this->subscription->insertSubscription($data);
    }

    public function delete($id)
    {
        return $this->subscription->deleteSubscription($id);
    }

    public function update($data)
    {
        return $this->subscription->updateSubscription($data);
    }

    public function count(){
        return $this->subscription->countSubscription();
    }
}