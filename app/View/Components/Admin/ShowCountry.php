<?php

namespace App\View\Components\Admin;

use Closure;
use App\Models\Region;
use App\Models\Country;
use App\Concerns\DataMethods;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ShowCountry extends Component
{
    use DataMethods;

    public array $interests;
    public array $wildlives;
    public array $regions;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public Country $item,
    ) {
        $this->getRegions($item);
        $this->interests = $this->getSimpleDatas('interests', $item->region->interests->toArray());
        $this->wildlives = $this->getSimpleDatas('wildlives', $item->region->wildlives->toArray());
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.show-country');
    }

    protected function getRegions($item): void
    {
        $this->regions = [
            'all' => [],
            'selected' => null,
        ];
        foreach (Region::all() as $c) {
            $this->regions['all'][] = [
                'name' => $c->title,
                'code' => $c->id,
            ];
        }
        if ($item->region) {
            $this->regions['selected'] =
                [
                    'name' => $item->region->title,
                    'code' => $item->region->id,
                ];
        }
    }
}
