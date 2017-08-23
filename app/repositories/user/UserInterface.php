<?php

namespace App\Repositories\User;

interface userInterface {

    public function getAll();

    public function find($id);

    public function insert($data);

    public function delete($id);

    public function findByEmail($email);
    
    public function findByNewEmail($new_email);

    public function update($data);
}