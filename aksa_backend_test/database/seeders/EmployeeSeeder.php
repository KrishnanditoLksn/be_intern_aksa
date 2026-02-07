<?php

namespace Database\Seeders;

use App\Models\Division;
use App\Models\Employee;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class EmployeeSeeder extends Seeder
{
    public function run(): void
    {
        $mobileId =  Division::where('name', 'Mobile Development')->first();

        Employee::create([
            'image'       => 'https://via.placeholder.com/150',
            'name'        => 'Joko Susilo',
            'phone'       => '081234567890',
            'position'    => 'Backend Developer',
            'division_id' => $mobileId->id,
        ]);
    }
}
