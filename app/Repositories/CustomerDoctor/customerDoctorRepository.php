<?php
namespace App\Repositories\CustomerDoctor;

use App\Repositories\CustomerDoctor\customerDoctorInterface as customerDoctorInterface;
use App\CustomerDoctor;

class customerDoctorRepository implements customerDoctorInterface
{
    public $customer_doctor;

    function __construct(CustomerDoctor $customer_doctor) {
	$this->customer_doctor = $customer_doctor;
    }

    public function getAll($offset, $limit, $search)
    {
        return $this->customer_doctor->getAll($offset, $limit, $search);
    }

    public function find($id)
    {
        return $this->customer_doctor->findCustomerDoctor($id);
    }

    public function insert($data)
    {
        return $this->customer_doctor->insertCustomerDoctor($data);
    }

    public function delete($id)
    {
        return $this->customer_doctor->deleteCustomerDoctor($id);
    }

    public function update($data)
    {
        return $this->customer_doctor->updateCustomerDoctor($data);
    }

    public function getAllByDoctorId($doctor_id) {
        return $this->customer_doctor->getAllByDoctorId($doctor_id);
    }

    public function count(){
        return $this->customer_doctor->countCustomerDoctor();
    }
}