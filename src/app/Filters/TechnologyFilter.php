<?php

namespace App\Filters;

use App\Models\Project;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Builder;
use LaravelIdea\Helper\App\Models\_IH_Project_C;

class TechnologyFilter
{
    public function apply(Builder $query, array $filters): Builder
    {
        if (!empty($filters['technologies'])) {

            $technologies = explode('-', $filters['technologies']);
            $technologies = array_filter($technologies);
            $technologies = array_unique($technologies);
            $technologies = array_values($technologies); // ['php', 'laravel', 'docker']

            if (!empty($technologies)) {
                $query->whereHas('technologies', function ($query) use ($technologies) {
                    $query->whereIn('slug', $technologies);
                });
            }
        }

        return $query;
    }
}
