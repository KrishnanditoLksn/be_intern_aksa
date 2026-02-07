<?php

namespace Database\Seeders;

use App\Models\Division;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DivisionSeeder extends Seeder
{
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Division::truncate();
        Schema::enableForeignKeyConstraints();

        $divisions = [
            ['name' => 'Mobile Development'],
            ['name' => 'UI/UX Designer'],
            ['name' => 'Back End Developer'],
            ['name' => 'Front End Developer'],
            ['name' => 'Quality Assurance'],
        ];

        foreach ($divisions as $division) {
            Division::create($division);
        }
    }
}
