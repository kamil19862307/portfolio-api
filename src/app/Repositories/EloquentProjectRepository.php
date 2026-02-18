<?php

namespace App\Repositories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Routing\Redirector;

class EloquentProjectRepository implements ProjectRepositoryInterface
{
    public function getAll(): Collection
    {
        return Project::with('technologies')->get();
    }

    public function findBySlug(string $slug): Project
    {
        return Project::with('technologies')
            ->where('slug', $slug)
            ->firstOrFail();
    }

    public function deleteBySlug(string $slug): void
    {
        $project = $this->findBySlug($slug);

        $project->delete();
    }
}
