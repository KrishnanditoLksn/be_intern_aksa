<?php

namespace App\Services;

use App\Repositories\DivisionRepository;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use App\Models\Division;

class DivisionService
{
    protected DivisionRepository $divisionRepository;

    public function __construct(DivisionRepository $divisionRepository)
    {
        $this->divisionRepository = $divisionRepository;
    }

    public function getAllDivisionByName($name)
    {
        return $this->divisionRepository->getDivisions($name);
    }
}
