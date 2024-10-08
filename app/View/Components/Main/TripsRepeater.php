<?php

namespace App\View\Components\Main;

use App\Models\Trip;
use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;

class TripsRepeater extends Component
{
    public Collection $trips;
    /**
     * Create a new component instance.
     */
    public function __construct(
        $trips = null
    ) {
        $this->trips = $trips ?? Trip::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.main.trips-repeater');
    }
}