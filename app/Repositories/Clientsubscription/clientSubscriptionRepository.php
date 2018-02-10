<?php
namespace App\Repositories\ClientSubscription;

use App\Repositories\ClientSubscription\clientSubscriptionInterface as clientSubscriptionInterface;
use App\clientSubscription;

class clientSubscriptionRepository implements clientSubscriptionInterface
{
    public $client_subscription;

    function __construct(clientSubscription $client_subscription) {
	$this->client_subscription = $client_subscription;
    }

    public function getAll($offset, $limit, $search)
    {
        return $this->client_subscription->getAll($offset, $limit, $search);
    }

    public function find($id)
    {
        return $this->client_subscription->findClientSubscription($id);
    }

    public function insert($data)
    {
        return $this->client_subscription->insertClientSubscription($data);
    }

    public function delete($id)
    {
        return $this->client_subscription->deleteClientSubscription($id);
    }

    public function update($data)
    {
        return $this->client_subscription->updateClientSubscription($data);
    }

    public function count(){
        return $this->client_subscription->countClientSubscription();
    }
}