<?php

namespace App\Services;

use App\Repositories\EmployeeRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\Employee;

class EmployeeService
{

    protected EmployeeRepository $employeeRepository;

    public function __construct(EmployeeRepository $authRepository)
    {
        $this->employeeRepository = $authRepository;
    }

    public function getAll(array $data)
    {
        return $this->employeeRepository->getEmployees($data);
    }

    public function createEmployee(array $data)
    {
        return $this->employeeRepository->addEmployees($data);
    }

    public function getEmployeeByName($name)
    {
        return $this->employeeRepository->getEmployeeByName($name);
    }

    public function deleteEmployee($id)
    {
        return $this->employeeRepository->deleteEmployee($id);
    }

    public function updateEmployee(string $id, array $data)
    {
        return $this->employeeRepository->updateEmployee($id, $data);
    }
}
