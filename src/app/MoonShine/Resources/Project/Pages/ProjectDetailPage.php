<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Project\Pages;

use App\Models\Technology;
use App\MoonShine\Resources\Technology\TechnologyResource;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;
use MoonShine\Laravel\Pages\Crud\DetailPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\UI\Components\Badge;
use MoonShine\UI\Components\Link;
use MoonShine\UI\Components\Table\TableBuilder;
use MoonShine\Contracts\UI\FieldContract;
use App\MoonShine\Resources\Project\ProjectResource;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use Throwable;


/**
 * @extends DetailPage<ProjectResource>
 */
class ProjectDetailPage extends DetailPage
{
    /**
     * @return list<FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            ID::make(),
            Text::make('Title', 'title'),
            Text::make('Slug', 'slug'),
            Textarea::make('Description', 'description'),
            Text::make('Is locked', 'is_locked'),
            Image::make('Image', 'image'),
            Text::make('Status', 'status'),
            BelongsToMany::make('Technologies',
                'technologies',
                formatted: 'name',
                resource: TechnologyResource::class
            )->inLine(
                separator: ' ',
                badge: fn($model, $value) => Badge::make((string) $value, 'primary'),
                link: fn(Technology $property, $value): string|Link => Link::make(
                    app(TechnologyResource::class)->getDetailPageUrl($property->id),
                    $value
                )),
            Text::make('Position', 'position'),
            Text::make('Development days', 'development_days'),
            Text::make('GitHub Url', 'github_url'),
            Text::make('Demo Url', 'demo_url'),
        ];
    }

    protected function buttons(): ListOf
    {
        return parent::buttons();
    }

    /**
     * @param  TableBuilder  $component
     *
     * @return TableBuilder
     */
    protected function modifyDetailComponent(ComponentContract $component): ComponentContract
    {
        return $component;
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function topLayer(): array
    {
        return [
            ...parent::topLayer()
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function mainLayer(): array
    {
        return [
            ...parent::mainLayer()
        ];
    }

    /**
     * @return list<ComponentContract>
     * @throws Throwable
     */
    protected function bottomLayer(): array
    {
        return [
            ...parent::bottomLayer()
        ];
    }
}
