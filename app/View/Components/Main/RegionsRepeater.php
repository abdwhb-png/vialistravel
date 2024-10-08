<?php

namespace App\View\Components\Main;

use App\Models\Region;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class RegionsRepeater extends Component
{
    public Collection $regions;
    /**
     * Create a new component instance.
     */
    public function __construct(
        $regions = null
    ) {
        $this->regions = $regions ?? Region::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.main.regions-repeater');
    }
}