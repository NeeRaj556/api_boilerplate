<?php

namespace Database\Seeders;

use App\Models\JobCategory;
use Illuminate\Database\Seeder;

class JobCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jobCategories = [
            'Software Development',
            'Design & Creative',
            'Sales & Marketing',
            'Finance & Accounting',
            'Human Resources',
            'Operations',
            'Customer Support',
            'Data & Analytics',
        ];

        foreach ($jobCategories as $index => $category) {
            JobCategory::create([
                'name' => $category,
                'rank' => $index + 1,
                'status' => 1,
            ]);
        }
    }
}
