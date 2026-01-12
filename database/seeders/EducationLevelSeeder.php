<?php

namespace Database\Seeders;

use App\Models\EducationLevel;
use Illuminate\Database\Seeder;

class EducationLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $educationLevels = [
            'No Formal Education',
            'Primary Education',
            'Secondary / High School',
            'Diploma / Certificate',
            'Undergraduate (Bachelor\'s Degree)',
            'Graduate (Master\'s Degree)',
            'Postgraduate Diploma',
            'Doctorate (PhD / DPhil)',
            'Professional Degree (MD, JD, CA, CPA, ACCA, Engineering License, etc.)',
            'Vocational / Technical Training',
            'Other',
            'Not Required',
        ];

        foreach ($educationLevels as $index => $level) {
            EducationLevel::create([
                'name' => $level,
                'rank' => $index + 1,
                'status' => 1,
            ]);
        }
    }
}
