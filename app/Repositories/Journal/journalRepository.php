<?php
namespace App\Repositories\Journal;
use App\Repositories\Journal\journalInterface as journalInterface;
use App\Journal;

class journalRepository implements journalInterface
{
    public $journal;

    function __construct(Journal $journal) {
	$this->journal = $journal;
    }

    public function getAll($offset, $limit, $search)
    {
        return $this->journal->getAll($offset, $limit, $search);
    }

    public function find($id)
    {
        return $this->journal->findJournal($id);
    }

    public function insert($data)
    {
        return $this->journal->insertJournal($data);
    }

    public function delete($id)
    {
        return $this->journal->deleteJournal($id);
    }

    public function update($data)
    {
        return $this->journal->updateAJournal($data);
    }

    public function count(){
        return $this->journal->countJournal();
    }
}