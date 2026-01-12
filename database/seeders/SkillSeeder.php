<?php

namespace Database\Seeders;

use App\Models\Skill;
use Illuminate\Database\Seeder;

class SkillSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $skills = [
            'Laravel',
            'Node.js',
            'React',
            'Python',
            'MySQL',
            'Docker',
            'Communication',
            'Project Management',
        ];

        foreach ($skills as $index => $skill) {
            Skill::create([
                'name' => $skill,
                'rank' => $index + 1,
                'status' => 1,
            ]);
        }
    }
}
