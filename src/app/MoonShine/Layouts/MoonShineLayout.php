<?php

declare(strict_types=1);

namespace App\MoonShine\Layouts;

use MoonShine\Laravel\Layouts\AppLayout;
use MoonShine\ColorManager\Palettes\PurplePalette;
use MoonShine\ColorManager\ColorManager;
use MoonShine\Contracts\ColorManager\ColorManagerContract;
use MoonShine\Contracts\ColorManager\PaletteContract;
use App\MoonShine\Resources\Project\ProjectResource;
use MoonShine\MenuManager\MenuItem;
use MoonShine\UI\Components\Layout\Footer;
use App\MoonShine\Resources\Technology\TechnologyResource;

final class MoonShineLayout extends AppLayout
{
    /**
     * @var null|class-string<PaletteContract>
     */
    protected ?string $palette = PurplePalette::class;

    protected function assets(): array
    {
        return [
            ...parent::assets(),
        ];
    }

    protected function menu(): array
    {
        return [
            ...parent::menu(),
            MenuItem::make(ProjectResource::class, 'Projects'),
//            MenuItem::make('/', 'Go')->icon('s.users'),
            MenuItem::make(TechnologyResource::class, 'Technologies'),
        ];
    }

    /**
     * @param ColorManager $colorManager
     */
    protected function colors(ColorManagerContract $colorManager): void
    {
        parent::colors($colorManager);

        // $colorManager->primary('#00000');
    }

    protected function getFooterCopyright(): string
    {
        return 'Copyright &copy; ' . date('Y');
    }

    protected function getFooterComponent(): Footer
    {
        return parent::getFooterComponent()->menu(['/admin' => 'Home']);
    }
}
