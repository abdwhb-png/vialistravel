<?php

namespace App\View\Components\Main;

use Closure;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;

class MobileBreadcrumb extends Component
{
    public ?string $pageName;
    /**
     * Create a new component instance.
     */
    public function __construct(
        ?string $pageName = null,
        public ?array $list = []
    ) {
        $this->pageName = $pageName ?? Str::ucfirst(str_replace('-', ' ', Route::currentRouteName()));
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.main.mobile-breadcrumb');
    }
}