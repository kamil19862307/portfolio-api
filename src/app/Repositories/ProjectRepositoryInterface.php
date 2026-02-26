<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Builder;

interface ProjectRepositoryInterface
{
    public function query(): Builder;

    public function findBySlug(string $slug);

    public function create(array $attributes);

    public function updateBySlug(string $slug, array $attributes);

    public function deleteBySlug(string $slug);

    public function slugExists(string $slug): bool;
}
