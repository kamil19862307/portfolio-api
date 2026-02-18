<?php

namespace App\Services;

use App\Repositories\ProjectRepositoryInterface;

class ProjectService
{
    public function __construct(
        private ProjectRepositoryInterface $repository,
    )
    {}

    public function list()
    {
        return $this->repository->getAll();
    }

    public function show(string $slug)
    {
        return $this->repository->findBySlug($slug);
    }

    public function delete(string $slug)
    {
        return $this->repository->deleteBySlug($slug);
    }
}
