<?php

namespace App\Repositories\CustomerDoctor;

interface customerDoctorInterface {

    public function getAll($offset, $limit, $search);

    public function find($id);

    public function insert($data);

    public function delete($id);

    public function update($data);

    public function getAllByDoctorId($doctor_id);

    public function count();
}