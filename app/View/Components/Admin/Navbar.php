<?php

namespace App\View\Components\Admin;

use Closure;
use App\Models\Faq;
use App\Models\Trip;
use App\Models\Region;
use App\Models\Country;
use App\Models\Interest;
use App\Models\Review;
use App\Models\Wildlife;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Navbar extends Component
{
    public array $deleteDatas;
    public array $selected;
    /**
     * Create a new component instance.
     */
    public function __construct(public string $pageName = '')
    {
        $route_prefix = config('vars.admin_route_prefix');

        $datas = [
            'trips' => Trip::all(),
            'regions' => Region::all(),
            'countries' => Country::all(),
            'interests' => Interest::all(),
            'wildlives' => Wildlife::all(),
            'faqs' => Faq::all(),
        ];
        foreach ($datas as $key => $values) {
            $this->selected[$key] = null;
            $this->deleteDatas[$key] = null;
            foreach ($values as $item) {
                $name = $item->title;
                if ($key == 'faqs')
                    $name = $item->question;
                $this->deleteDatas[$key][] = [
                    'name' => $name,
                    'code' => $item->id,
                    'delete_route' => route($route_prefix . 'massDeleteData', $key),
                ];
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.navbar');
    }
}
