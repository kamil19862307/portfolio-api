<?php

namespace App\Repositories;

use App\Filters\TechnologyFilter;
use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class EloquentProjectRepository implements ProjectRepositoryInterface
{
    public function query(): Builder
    {
        return Project::query();
    }

    public function findBySlug(string $slug): Project
    {
        return Project::with('technologies')
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function create(array $attributes)
    {
        return Project::create($attributes);
    }

    public function updateBySlug(string $slug, array $attributes): Project
    {
        $project = $this->findBySlug($slug);

        $project->update($attributes);

        return $project;
    }

    public function slugExists(string $slug): bool
    {
        return Project::where('slug', $slug)->exists();
    }

    public function deleteBySlug(string $slug): void
    {
        $project = $this->findBySlug($slug);

        $project->delete();
    }
}
