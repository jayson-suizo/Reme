<?php
namespace App\Repositories\Answer;

use App\Repositories\Answer\answerInterface as answerInterface;
use App\Answer;

class answerRepository implements answerInterface
{
    public $answer;

    function __construct(Answer $answer) {
	$this->answer = $answer;
    }

    public function getAll($offset, $limit, $search)
    {
        return $this->answer->getAll($offset, $limit, $search);
    }

    public function find($id)
    {
        return $this->answer->findAnswer($id);
    }

    public function insert($data)
    {
        return $this->answer->insertAnswer($data);
    }

    public function delete($id)
    {
        return $this->answer->deleteAnswer($id);
    }

    public function update($data)
    {
        return $this->answer->updateAnswer($data);
    }

    public function count(){
        return $this->answer->countAnswer();
    }
}