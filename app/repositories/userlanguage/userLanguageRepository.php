<?php
namespace App\Repositories\userLanguage;

use App\Repositories\userLanguage\userLanguageInterface as userLanguageInterface;
use App\UserLanguage;

class userLanguageRepository implements userLanguageInterface
{
    public $user_language;

    function __construct(UserLanguage $user_language) {
	   $this->user_language = $user_language;
    }

    // public function getAll($offset, $limit, $search)
    // {
    //     return $this->activity->getAll($offset, $limit, $search);
    // }

    public function find($id)
    {
        return $this->user_language->findUserLanguage($id);
    }

    // public function insert($data)
    // {
    //     return $this->activity->insertActivity($data);
    // }

    // public function delete($id)
    // {
    //     return $this->activity->deleteActivity($id);
    // }

    // public function update($data)
    // {
    //     return $this->activity->updateActivity($data);
    // }

    // public function count(){
    //     return $this->activity->countActivity();
    // }


   
}