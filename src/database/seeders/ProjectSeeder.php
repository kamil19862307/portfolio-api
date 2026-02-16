<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Technology;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $technologyIds = Technology::pluck('id');

        $projects = Project::factory()
            ->count(6)
            ->create();

        foreach ($projects as $project) {

            $randomIds = $technologyIds->random(rand(2, 4));

            $project->technologies()->attach($randomIds);
        }
    }
}
