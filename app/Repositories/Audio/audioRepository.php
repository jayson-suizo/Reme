<?php
namespace App\Repositories\Audio;

use App\Repositories\Audio\audioInterface as audioInterface;
use App\Audio;

class audioRepository implements audioInterface
{
    public $audio;

    function __construct(Audio $audio) {
	$this->audio = $audio;
    }

    public function getAll($offset, $limit, $search)
    {
        return $this->audio->getAll($offset, $limit, $search);
    }

    public function find($id)
    {
        return $this->audio->findAudio($id);
    }

    public function insert($data)
    {
        return $this->audio->insertAudio($data);
    }

    public function delete($id)
    {
        return $this->audio->deleteAudio($id);
    }

    public function update($data)
    {
        return $this->audio->updateAudio($data);
    }

    public function count(){
        return $this->audio->countAudio();
    }

    public function lastId(){
        return $this->audio->lastId();
    }
}