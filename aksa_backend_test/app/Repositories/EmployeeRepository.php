<?php

namespace App\Repositories;

use App\Models\Employee;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
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

    public function updateEmployee(string $id, array $data)
    {
        $employee = Employee::findOrFail($id);
        $name     = $data['name'];
        $phone    = $data['phone'];
        $division  = $data['division'];
        $position = $data['position'];
        $imagePath = $employee->image;

        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            if ($employee->image && Storage::disk('public')->exists('employees/' . $employee->image)) {
                Storage::disk('public')->delete('employees/' . $employee->image);
            }
            $file = $data['image'];
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('employees', $imageName, 'public');
            $imagePath = $imageName;
        }

        $employee->update([
            'image'       => $imagePath,
            'name'        => $name,
            'phone'       => $phone,
            'division' => $division,
            'position'    => $position,
        ]);

        return $employee;
    }
}
