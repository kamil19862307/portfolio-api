<?php

namespace App\DTOs;

use Illuminate\Http\UploadedFile;

class ProjectStoreDTO
{
    public function __construct(
        public string $title,
        public string $description,
        public UploadedFile $image,
        public int $position,
        public bool $is_locked,
        public string $status,
        public string $development_days,
        public string $github_url,
        public string $demo_url,
        public ?array $technologies = null,
    )
    {
    }
}
