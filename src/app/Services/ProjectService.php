<?php

namespace App\Services;

use App\Filters\TechnologyFilter;
use App\Http\Requests\ProjectStoreRequest;
use App\Models\Project;
use App\Repositories\ProjectRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProjectService
{
    public function __construct(
        private ProjectRepositoryInterface $repository,
    )
    {}

    public function list(array $filters = []): Collection
    {
        $query = $this->repository
            ->query()
            ->with('technologies');

        $filter = new TechnologyFilter();

        $query = $filter->apply($query, $filters);

        return $query->get();
    }

    public function show(string $slug)
    {
        return $this->repository->findBySlug($slug);
    }

    public function store(array $data)
    {
        return DB::transaction(function () use ($data) {

            $slug = Str::slug($data['title']);

            if ($this->repository->slugExists($slug)) {
                throw new \Exception('Slug already exists.');
            }

            $data['slug'] = $slug;

            if (isset($data['image'])) {
                $data['image'] = $data['image']->store('projects', 'public');
            }

            $project = $this->repository->create($data);

            if (!empty($data['technologies'])) {
                $project->technologies()->sync($data['technologies']);
            }

            return $project->load('technologies');
        });
    }

    public function update(string $slug, array $attributes)
    {
        return DB::transaction(function () use ($slug, $attributes) {

            $project = $this->repository->findBySlug($slug);

            if (isset($attributes['title'])) {
                $newSlug = Str::slug($attributes['title']);

                if ($newSlug !== $project->slug && $this->repository->slugExists($newSlug)) {
                    throw new \Exception('Slug already exists.');
                }

                $attributes['slug'] = $newSlug;
            }

            $updated = $this->repository->updateBySlug($slug, $attributes);

            if (isset($attributes['technologies'])) {
                $updated->technologies()->sync($attributes['technologies']);
            }

            return $updated->load('technologies');
        });
    }

    public function delete(string $slug)
    {
        $project = $this->repository->findBySlug($slug);

        if ($project->isLocked()) {
            throw new \Exception('Project is locked.');
        }

        return $this->repository->deleteBySlug($slug);
    }
}
