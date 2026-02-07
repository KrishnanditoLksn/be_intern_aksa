<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\DivisionRepository;
use App\Services\DivisionService;

class DivisionController extends Controller
{
    protected DivisionService $division;
    public function __construct(DivisionService $division)
    {
        $this->division = $division;
    }

    public function getAllDivision(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        try {
            $res = $this->division->getAllDivisionByName([
                "name" => $request->name,
            ]);
            return response()->json([
                'status' => 'success',
                'message' => 'List Divisions',
                'data' => $res,
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => 'error',
                'message' => $th->getMessage()
            ], 401);
        }
    }
}
