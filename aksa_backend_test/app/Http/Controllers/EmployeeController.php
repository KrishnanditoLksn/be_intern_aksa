<?php

namespace App\Http\Controllers;

use App\Services\EmployeeService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    protected EmployeeService $employee;

    public function __construct(EmployeeService $employee)
    {
        $this->employee = $employee;
    }

    public function getAllEmployees(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'division_id' => 'required',
        ]);

        try {
            $res = $this->employee->getAll([
                "name" => $request->name,
                "division_id" => $request->division_id
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'Employee Found',
                'data' => $res,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 401);
        }
    }

    public function addEmployees(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'image'    => 'required|image|mimes:jpeg,png,jpg|max:2048',
                'name'     => 'required|string|max:255',
                'phone'    => 'required|string|max:15',
                'division_id' => 'required|uuid|exists:divisions,id',
                'position' => 'required|string|max:255',
            ]
        );

        try {
            if ($validator->fails()) {
                return response()->json([
                    'status' => "error",
                    'message' => 'Validation error',
                    'errors' => $validator->errors()
                ], 422);
            }


            $data = $request->all();


            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $path = $file->store('employees', 'public');


                $data['image'] = asset('storage/' . $path);
            }


            if ($this->employee->getEmployeeByName($data)) {
                return response()->json([
                    "status" => "error",
                    "message" => "Employee Already Exists"
                ], 409);
            } else {
                $this->employee->createEmployee($data);

                return response()->json([
                    'status' => "success",
                    'message' => 'Employee created successfully',
                ], 201);
            }
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function deleteEmployees($id)
    {
        try {
            $this->employee->deleteEmployee($id);
            return response()->json([
                'status' => "success",
                'message' => 'Employee deleted successfully',
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }

    public function updateEmployees($uuid, Request $request)
    {
        try {

            $this->employee->updateEmployee(
                $uuid,
                $request->all()
            );

            return response()->json([
                'status' => "success",
                'message' => 'Employee updated successfully',
            ], 201);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 500);
        }
    }
}
