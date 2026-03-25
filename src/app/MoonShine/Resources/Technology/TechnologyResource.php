<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Technology;

use Illuminate\Database\Eloquent\Model;
use App\Models\Technology;
use App\MoonShine\Resources\Technology\Pages\TechnologyIndexPage;
use App\MoonShine\Resources\Technology\Pages\TechnologyFormPage;
use App\MoonShine\Resources\Technology\Pages\TechnologyDetailPage;

use MoonShine\Laravel\Resources\ModelResource;
use MoonShine\Contracts\Core\PageContract;

/**
 * @extends ModelResource<Technology, TechnologyIndexPage, TechnologyFormPage, TechnologyDetailPage>
 */
class TechnologyResource extends ModelResource
{
    protected string $model = Technology::class;

    protected string $title = 'Technologies';

    protected string $column = 'name';

    /**
     * @return list<class-string<PageContract>>
     */
    protected function pages(): array
    {
        return [
            TechnologyIndexPage::class,
            TechnologyFormPage::class,
            TechnologyDetailPage::class,
        ];
    }
}
