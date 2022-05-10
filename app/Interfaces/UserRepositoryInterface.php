<?php

namespace App\Interfaces;

interface UserRepositoryInterface 
{
    public function saveEmployee($request);
    public function getAllEmployees();
    public function isExistEmployee($id);
    public function updateEmployee($request);
    public function deleteEmployee($id);
}
