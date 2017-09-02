<?php
namespace App\Repositories\Language;

use App\Repositories\Language\languageInterface as languageInterface;
use App\Language;

class languageRepository implements languageInterface
{
    public $language;

    function __construct(Language $language) {
	   $this->language = $language;
    }

    // public function getAll($offset, $limit, $search)
    // {
    //     return $this->activity->getAll($offset, $limit, $search);
    // }

    public function find($id)
    {
        return $this->language->findLanguage($id);
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