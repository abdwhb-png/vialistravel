<?php

namespace App\View\Components\Main;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Storage;

class Slider extends Component
{
    public array $datas = [];
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $datas = Storage::json('sliders.json');
        foreach ($datas as $d) {
            $d['permalink'] = '#';
            $d['image'] = asset('assets/images/sliders/' . $d['img']);
            $this->datas[] = $d;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.main.slider');
    }
}
