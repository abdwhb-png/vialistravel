<?php

namespace App\View\Components\Main;

use Closure;
use App\Models\Region;
use App\Models\Interest;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Modals extends Component
{
    public $regions;
    public $interests;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->regions = Region::all();
        $this->interests = Interest::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.main.modals');
    }
}