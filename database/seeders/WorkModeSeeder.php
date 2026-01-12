<?php

namespace Database\Seeders;

use App\Models\WorkMode;
use Illuminate\Database\Seeder;

class WorkModeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $workModes = [
            'On-site',
            'Remote',
            'Hybrid',
        ];

        foreach ($workModes as $index => $mode) {
            WorkMode::create([
                'name' => $mode,
                'rank' => $index + 1,
                'status' => 1,
            ]);
        }
    }
}
