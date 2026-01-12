<?php

namespace Database\Seeders;

use App\Models\Industry;
use Illuminate\Database\Seeder;

class IndustrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $industries = [
            'Information Technology',
            'Software & SaaS',
            'FinTech',
            'Health & Medical',
            'Education',
            'Construction',
            'Manufacturing',
            'Hospitality',
            'NGO / INGO',
            'Government',
            'Media & Marketing',
            'E-commerce',
            'Agriculture',
            'Banking & Finance',
        ];

        foreach ($industries as $index => $industry) {
            Industry::create([
                'name' => $industry,
                'rank' => $index + 1,
                'status' => 1,
            ]);
        }
    }
}
