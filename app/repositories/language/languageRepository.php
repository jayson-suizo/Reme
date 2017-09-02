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

    public function getAll($offset, $limit, $search)
    {
        return $this->language->getAll($offset, $limit, $search);
    }

    public function find($id)
    {
        return $this->language->findLanguage($id);
    }

    public function insert($data)
    {
        return $this->language->insertLanguage($data);
    }

    public function delete($id)
    {
        return $this->language->deleteLanguage($id);
    }

    public function update($data)
    {
        return $this->language->updateLanguage($data);
    }

    public function count(){
        return $this->language->countLanguage();
    }
}