<?php
namespace App\Repositories\UserSubscription;

use App\Repositories\UserSubscription\userSubscriptionInterface as userSubscriptionInterface;
use App\userSubscription;

class userSubscriptionRepository implements userSubscriptionInterface
{
    public $user_subscription;

    function __construct(userSubscription $user_subscription) {
	   $this->user_subscription = $user_subscription;
    }

    public function getAll($offset, $limit, $search)
    {
        return $this->user_subscription->getAll($offset, $limit, $search);
    }

    public function find($id)
    {
        return $this->user_subscription->findUserLanguage($id);
    }

    public function insert($data)
    {
        return $this->user_subscription->insertUserLanguage($data);
    }

    public function delete($id)
    {
        return $this->user_subscription->deleteUserLanguage($id);
    }

    public function update($data)
    {
        return $this->user_subscription->updateUserLanguage($data);
    }

    public function count(){
        return $this->user_subscription->countUserLanguage();
    }


   
}