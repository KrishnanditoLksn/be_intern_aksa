<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Request;

class EmployeeRepository
{
    public function getEmployees(array $data)
    {
        $name = $data['name'];
        $div_id = $data['division_id'];

        $employees = Employee::with(['division'])
            ->when($name, function ($query, $name) {
                return $query->where('name', 'like', "%$name%");
            })
            ->when($div_id, function ($query, $div_id) {
                return $query->where('division_id', $div_id);
            })
            ->paginate(10);


        return [
            'employees' => $employees->items(),
            'pagination' => [
                'total'        => $employees->total(),
                'per_page'     => $employees->perPage(),
                'current_page' => $employees->currentPage(),
                'last_page'    => $employees->lastPage(),
                'from'         => $employees->firstItem(),
                'to'           => $employees->lastItem(),
            ]
        ];
    }

    public function addEmployees(array $data)
    {
        $employee = Employee::create($data);
        return $employee;
    }
    public function getEmployeeByName($name)
    {
        return Employee::where('name', $name)->first();
    }

    public function deleteEmployee($id)
    {
        return Employee::where("id", $id)->delete();
    }
}
