<?php

namespace App\View\Components\Admin;

use Closure;
use App\Models\Trip;
use App\Models\Region;
use App\Models\Country;
use App\Models\Interest;
use App\Models\Wildlife;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ShowRegion extends Component
{
    public array $hero;
    public array $pic;
    public array $trips;
    public array $countries;
    public array $interests;
    public array $wildlives;
    public array $medias;
    public array $routes;
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $type,
        public Region $item,
    ) {
        $this->hero = [
            'theItem_id' => $item->id,
            'name' => 'Region_' . $item->id . ' hero image',
            'data_media' => 'hero',
        ];
        $this->pic = [
            'theItem_id' => $item->id,
            'name' => 'Region_' . $item->id . ' main pic',
            'data_media' => 'pic',
        ];

        $this->getTrips($item);
        $this->getCountries($item);
        $this->getInterests($item);
        $this->getWildlives($item);
        $this->getMedias($item);

        $this->getRoutes($type);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.show-region');
    }

    protected function getTrips($item): void
    {
        $this->trips = [
            'all' => [],
            'selected' => [],
        ];
        foreach (Trip::all() as $c) {
            $text = '';
            if ($c->region && $c->region->id != $item->id) {
                $text = ' (' . $c->region->title . ')';
            }
            $this->trips['all'][] = [
                'name' => $c->title . $text,
                'code' => $c->id,
            ];
        }
        foreach ($item->trips as $c) {
            $this->trips['selected'][] = [
                'name' => $c->title,
                'code' => $c->id,
            ];
        }
    }

    protected function getCountries($item): void
    {
        $this->countries = [
            'all' => [],
            'selected' => [],
        ];
        foreach (Country::all() as $c) {
            $text = '';
            if ($c->region && $c->region->id != $item->id) {
                $text =
                    ' (' . $c->region->title . ')';
            }
            $this->countries['all'][] = [
                'name' => $c->title . $text,
                'code' => $c->id,
            ];
        }
        foreach ($item->countries as $c) {
            $this->countries['selected'][] = [
                'name' => $c->title,
                'code' => $c->id,
            ];
        }
    }

    protected function getInterests($item): void
    {
        $this->interests = [
            'all' => [],
            'selected' => $item->interests()->distinct()->get()->toArray(),
        ];
        foreach (Interest::all() as $i) {
            if (!$item->interests()->find($i->id)) {
                $this->interests['all'][] = $i;
            }
        }
    }

    protected function getWildlives($item): void
    {
        $this->wildlives = [
            'all' => [],
            'selected' => $item->wildlives()->distinct()->get()->toArray(),
        ];
        foreach (Wildlife::all() as $i) {
            if (!$item->wildlives()->find($i->id)) {
                $this->wildlives['all'][] = $i;
            }
        }
    }

    protected function getMedias($item): void
    {
        $this->medias = [
            'pic' => [
                'src' => $item->medias()['pic'] ?? asset('images/no-image.webp'),
                'alt' => 'main-pic',
                'form_data' => $this->pic,
            ],
            'hero' => [
                'src' => $item->medias()['hero'] ?? asset('images/no-image.webp'),
                'alt' => 'hero-image',
                'form_data' => $this->hero,
            ],
        ];
    }

    protected function getRoutes($type): void
    {
        $route_prefix = config('vars.admin_route_prefix');
        $this->routes = [
            'save_trips' => route($route_prefix . 'update-region', 'trips'),
            'save_basics' => route($route_prefix . 'updt-data', $type),
            'save_countries' => route($route_prefix . 'update-region', 'countries'),
            'save_interests' => route($route_prefix . 'update-region', 'interests'),
            'save_wildlives' => route($route_prefix . 'update-region', 'wildlives'),
            'upload_media' => route($route_prefix . 'uplDataMedia', $type),
        ];
    }
}
