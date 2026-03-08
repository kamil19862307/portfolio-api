<?php

namespace App\Services;

use App\DTOs\ProjectStoreDTO;
use App\DTOs\ProjectUpdateDTO;
use App\Filters\TechnologyFilter;
use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Models\Project;
use App\Repositories\ProjectRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
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

    public function store(ProjectStoreDTO $dto)
    {
        return DB::transaction(function () use ($dto) {

            $slug = Str::slug($dto->title);

            if ($this->repository->slugExists($slug)) {
                throw new \Exception('Slug already exists.');
            }

            // Добавить проверку на наличие картинки?
            $imagePath = $dto->image->store('projects', 'public');

            $project = $this->repository->create([
                'title' => $dto->title,
                'slug' => $slug,
                'description' => $dto->description,
                'image' => $imagePath,
                'position' => $dto->position,
                'is_locked' => $dto->is_locked,
                'status' => $dto->status,
                'development_days' => $dto->development_days,
                'github_url' => $dto->github_url,
                'demo_url' => $dto->demo_url,
            ]);

            if ($dto->technologies) {
                $project->technologies()->sync($dto->technologies);
            }

            return $project->load('technologies');
        });
    }

    public function update(string $slug, ProjectUpdateDTO $dto)
    {
        return DB::transaction(function () use ($slug, $dto) {

            $project = $this->repository->findBySlug($slug);

            $data = [];

            if ($dto->title) {
                $data['title'] = $dto->title;
                $data['slug'] = Str::slug($dto->title);
            }

            if ($dto->description) {
                $data['description'] = $dto->description;
            }

            if ($dto->position !== null) {
                $data['position'] = $dto->position;
            }

            if ($dto->status) {
                $data['status'] = $dto->status;
            }

            if ($dto->development_days) {
                $data['development_days'] = $dto->development_days;
            }

            if ($dto->github_url) {
                $data['github_url'] = $dto->github_url;
            }

            if ($dto->demo_url) {
                $data['demo_url'] = $dto->demo_url;
            }

            if ($dto->is_locked !== null) {
                $data['is_locked'] = $dto->is_locked;
            }

            if ($dto->image){

                if ($project->image){
                    // Delete old image
                    Storage::disk('public')->delete($project->image);
                }

                $data['image'] = $dto->image->store('projects', 'public');
            }

            $project->update($data);

            if ($dto->technologies) {
                $project->technologies()->sync($dto->technologies);
            }

            return $project->load('technologies');
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
