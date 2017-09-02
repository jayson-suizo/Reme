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

    public function getAll($offset, $limit, $search)
    {
        return $this->user_language->getAll($offset, $limit, $search);
    }

    public function find($id)
    {
        return $this->user_language->findUserLanguage($id);
    }

    public function insert($data)
    {
        return $this->user_language->insertUserLanguage($data);
    }

    public function delete($id)
    {
        return $this->user_language->deleteUserLanguage($id);
    }

    public function update($data)
    {
        return $this->user_language->updateUserLanguage($data);
    }

    public function count(){
        return $this->user_language->countUserLanguage();
    }


   
}