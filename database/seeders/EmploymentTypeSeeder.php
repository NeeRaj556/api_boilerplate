<?php

namespace Database\Seeders;

use App\Models\EmploymentType;
use Illuminate\Database\Seeder;

class EmploymentTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $employmentTypes = [
            'Full-time',
            'Part-time',
            'Contract',
            'Freelance',
            'Internship',
            'Temporary',
        ];

        foreach ($employmentTypes as $index => $type) {
            EmploymentType::create([
                'name' => $type,
                'rank' => $index + 1,
                'status' => 1,
            ]);
        }
    }
}
