<?php

namespace App\Repositories;

interface ProjectRepositoryInterface
{
    public function getAll();

    public function findBySlug(string $slug);

    public function deleteBySlug(string $slug);
}
