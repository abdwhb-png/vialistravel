<?php

namespace App\View\Components\Main;

use Closure;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

class Hero extends Component
{
    public string $pageName;
    public string $heroImg;

    /**
     * Create a new component instance.
     */
    public function __construct(
        ?string $pageName = null,
        ?string $heroImg = null,
        public ?array $list = [],
    ) {
        $this->pageName = $pageName ?? Str::title(str_replace('-', ' ', Route::currentRouteName()));
        $this->heroImg = $heroImg ?? asset('assets/images/main-hero.jpg');
        $routeName = Route::currentRouteName();
        $this->conservationHero($routeName);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.main.hero');
    }

    protected function conservationHero($name): void
    {
        $tab = [
            'conservation',
            'quality-value-guarantee',
            'carbon-neutral-travel',
            'reduicing-waste'
        ];
        if (in_array($name, $tab))
            $this->heroImg = asset('assets/images/subpage-photos/conservation.jpg');
    }

    protected function ourStoryHero($name): void
    {
        $tab = [
            'our-story',
        ];
        if (in_array($name, $tab))
            $this->heroImg = asset('assets/images/subpage-photos/our-story.jpg');
    }
}