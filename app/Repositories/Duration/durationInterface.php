<?php

namespace App\Repositories\Duration;

interface durationInterface {

    public function getAll($offset, $limit, $search);

    public function find($id);

    public function insert($data);

    public function delete($id);

    public function update($data);

    public function count();
}