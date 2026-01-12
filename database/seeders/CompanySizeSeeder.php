<?php

namespace Database\Seeders;

use App\Models\CompanySize;
use Illuminate\Database\Seeder;

class CompanySizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companySizes = [
            '1-10 employees',
            '11-50 employees',
            '51-200 employees',
            '201-500 employees',
            '501-1000 employees',
            '1001-5000 employees',
            '5001-10000 employees',
            '10000+ employees',
        ];

        foreach ($companySizes as $index => $size) {
            CompanySize::create([
                'name' => $size,
                'rank' => $index + 1,
                'status' => 1,
            ]);
        }
    }
}
