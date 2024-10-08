<?php

namespace App\View\Components\Admin;

use Closure;
use App\Models\Region;
use App\Models\Interest;
use App\Concerns\DataMethods;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ShowInterest extends Component
{
    use DataMethods;
    public array $regions = [];
    /**
     * Create a new component instance.
     */
    public function __construct(public Interest $item)
    {
        $this->regions = [
            'table_list' => !$item->regions->count() ? ['list' => [], 'cols' => []] : $this->getSimpleDatas('regions', $item->regions->toArray()),
            'selected' => $item->regions()->distinct()->get()->toArray(),
            'all' => [],
        ];
        foreach (Region::all() as $r) {
            if (!$item->regions()->find($r->id)) {
                $this->regions['all'][] = $r;
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.show-interest');
    }
}
