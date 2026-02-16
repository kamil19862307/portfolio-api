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
        // Ids only
        $technologyIds = Technology::pluck('id');

        $projects = Project::factory()
            ->count(6)
            ->create();

        foreach ($projects as $project) {

            // Take some Ids for relating
            $randomIds = $technologyIds->random(rand(2, 4));

            // Insert into pivot table
            $project->technologies()->attach($randomIds);
        }
    }
}
