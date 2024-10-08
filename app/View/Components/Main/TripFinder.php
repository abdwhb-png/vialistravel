<?php

namespace App\View\Components\Main;

use App\Models\Country;
use App\Models\Interest;
use App\Models\Region;
use App\Models\Wildlife;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class TripFinder extends Component
{
    public Collection $regions;
    public Collection $countries;
    public Collection $interests;
    public Collection $wildlives;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->regions = Region::all();
        $this->countries = Country::all();
        $this->interests = Interest::all();
        $this->wildlives = Wildlife::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.main.trip-finder');
    }
}