<?php
namespace App\Repositories\Music;

use App\Repositories\Music\musicInterface as musicInterface;
use App\Music;

class musicRepository implements musicInterface
{
    public $music;

    function __construct(Music $music) {
	$this->music = $music;
    }

    public function getAll($offset, $limit, $search)
    {
        return $this->music->getAll($offset, $limit, $search);
    }

    public function find($id)
    {
        return $this->music->findMusic($id);
    }

    public function insert($data)
    {
        return $this->music->insertMusic($data);
    }

    public function delete($id)
    {
        return $this->music->deleteMusic($id);
    }

    public function update($data)
    {
        return $this->music->updateMusic($data);
    }

    public function count(){
        return $this->music->countMusic();
    }

    public function lastId(){
        return $this->music->lastId();
    }
}