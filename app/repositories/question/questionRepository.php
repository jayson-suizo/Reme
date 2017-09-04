<?php
namespace App\Repositories\Question;

use App\Repositories\Question\questionInterface as questionInterface;
use App\Question;

class questionRepository implements questionInterface
{
    public $question;

    function __construct(Question $question) {
	$this->question = $question;
    }

    public function getAll($offset, $limit, $search)
    {
        return $this->question->getAll($offset, $limit, $search);
    }

    public function find($id)
    {
        return $this->question->findQuestion($id);
    }

    public function insert($data)
    {
        return $this->question->insertQuestion($data);
    }

    public function delete($id)
    {
        return $this->question->deleteQuestion($id);
    }

    public function update($data)
    {
        return $this->question->updateQuestion($data);
    }

    public function count(){
        return $this->question->countQuestion();
    }
}