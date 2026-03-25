<?php

declare(strict_types=1);

namespace App\MoonShine\Resources\Project\Pages;

use App\MoonShine\Resources\Technology\TechnologyResource;
use MoonShine\Laravel\Fields\Relationships\BelongsToMany;
use MoonShine\Laravel\Pages\Crud\FormPage;
use MoonShine\Contracts\UI\ComponentContract;
use MoonShine\Contracts\UI\FormBuilderContract;
use MoonShine\UI\Components\FormBuilder;
use MoonShine\Contracts\UI\FieldContract;
use MoonShine\Contracts\Core\TypeCasts\DataWrapperContract;
use App\MoonShine\Resources\Project\ProjectResource;
use MoonShine\Support\ListOf;
use MoonShine\UI\Fields\ID;
use MoonShine\UI\Components\Layout\Box;
use MoonShine\UI\Fields\Image;
use MoonShine\UI\Fields\Text;
use MoonShine\UI\Fields\Textarea;
use Throwable;


/**
 * @extends FormPage<ProjectResource>
 */
class ProjectFormPage extends FormPage
{
    /**
     * @return list<ComponentContract|FieldContract>
     */
    protected function fields(): iterable
    {
        return [
            Box::make([
                ID::make(),
                Text::make('Title', 'title'),
                Text::make('Slug', 'slug'),
                Textarea::make('Description', 'description'),
                Text::make('Is locked', 'is_locked'),
                Image::make('Image', 'image')->dir('projects'),
                Text::make('Status', 'status'),
                BelongsToMany::make(
                    'Technologies',
                    'technologies',
                    'name',
                    TechnologyResource::class
                ),
                Text::make('Position', 'position'),
                Text::make('Development days', 'development_days'),
                Text::make('GitHub Url', 'github_url'),
                Text::make('Demo Url', 'demo_url'),
            ]),
        ];
    }

    protected function buttons(): ListOf
    {
        return parent::buttons();
    }

    protected function formButtons(): ListOf
    {
        return parent::formButtons();
    }

    protected function rules(DataWrapperContract $item): array
    {
        // If update
        if ($item->getKey() !== null) {
            return [
                'title' => 'sometimes|string|max:255',
                'description' => 'sometimes|string',
                'image' => 'sometimes|image|max:2048',
                'position' => 'sometimes|integer',
                'is_locked' => 'sometimes|boolean',
                'status' => 'sometimes|string|max:20',

                'technologies' => 'sometimes|array',
                'technologies.*' => 'distinct|exists:technologies,id',

                'development_days' => 'sometimes|string|max:255',
                'github_url' => 'sometimes|url|max:255',
                'demo_url' => 'sometimes|url|max:255',
            ];

        // If create
        } else {
            return [
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'image' => 'required|image|max:2048',
                'position' => 'required|integer',
                'is_locked' => 'required|boolean',
                'status' => 'required|string|max:20',

                'technologies' => 'required|array|min:1',
                'technologies.*' => 'distinct|exists:technologies,id',

                'development_days' => 'required|string|max:255',
                'github_url' => 'required|url|max:255',
                'demo_url' => 'required|url|max:255',
            ];
        }
    }

    /**
     * @param  FormBuilder  $component
     *
     * @return FormBuilder
     */
    protected function modifyFormComponent(FormBuilderContract $component): FormBuilderContract
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
