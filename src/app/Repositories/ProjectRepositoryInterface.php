<?php

namespace App\Repositories;

interface ProjectRepositoryInterface
{
    public function getAll();

    public function findBySlug(string $slug);

    public function create(array $attributes);

    public function updateBySlug(string $slug, array $attributes);

    public function deleteBySlug(string $slug);

    public function slugExists(string $slug): bool;
}
