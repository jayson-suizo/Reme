<?php

namespace App\Repositories\Group;

interface groupInterface {

    public function getAll($offset, $limit, $search);

    public function find($id);

    public function insert($data);

    public function delete($id);

    public function update($data);

    public function count();
}