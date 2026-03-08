<?php

namespace App\DTOs;

use Illuminate\Http\UploadedFile;

class ProjectUpdateDTO
{
    public function __construct(
        public ?string $title = null,
        public ?string $description = null,
        public ?UploadedFile $image = null,
        public ?int $position = null,
        public ?bool $is_locked = null,
        public ?string $status = null,
        public ?string $development_days = null,
        public ?string $github_url = null,
        public ?string $demo_url = null,
        public ?array $technologies = null,
    )
    {
    }
}
