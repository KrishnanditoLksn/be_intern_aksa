<?php

namespace App\Repositories;

use App\Models\Division;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Request;

class DivisionRepository
{
    public function getDivisions($name)
    {
        $divisionToFind = Division::where($name, function ($query, $name) {
            return $query->where('name', '=', "$name");
        })
            ->paginate(10);


        return [
            'data' => $divisionToFind->getCollection()->map(function ($division) {
                return [
                    'id' => $division->id,
                    'name' => $division->name,
                ];
            }),
            'pagination' => [
                'total'        => $divisionToFind->total(),
                'per_page'     => $divisionToFind->perPage(),
                'current_page' => $divisionToFind->currentPage(),
                'last_page'    => $divisionToFind->lastPage(),
                'from'         => $divisionToFind->firstItem(),
                'to'           => $divisionToFind->lastItem(),
            ]
        ];
    }
}
