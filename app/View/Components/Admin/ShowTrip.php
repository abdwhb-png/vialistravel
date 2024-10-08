<?php

namespace App\View\Components\Admin;

use Closure;
use App\Models\Trip;
use App\Models\Region;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ShowTrip extends Component
{
    public array $hero;
    public array $pic;
    public array $routes;
    public array $regions;
    public array $medias;
    protected string $route_prefix;
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $type,
        public Trip $item,
    ) {
        $this->route_prefix = config('vars.admin_route_prefix');;
        $this->hero = [
            'theItem_id' => $item->id,
            'name' => 'Trip_' . $item->id . ' hero image',
            'data_media' => 'hero',
        ];
        $this->pic = [
            'theItem_id' => $item->id,
            'name' => 'Trip_' . $item->id . ' main pic',
            'data_media' => 'pic',
        ];

        $this->getRegions($item);
        $this->getRoutes($type);
        $this->getMedias($item);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.show-trip');
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

    protected function getRoutes($type): void
    {
        $this->routes = [
            'save_region' => route($this->route_prefix . 'update-trip', 'region'),
            'save_overview' => route($this->route_prefix . 'update-trip', 'overview'),
            'save_basics' => route($this->route_prefix . 'updt-data', $type),
            'upload_media' => route($this->route_prefix . 'uplDataMedia', $type),
            'delete_review' => route($this->route_prefix . 'deleteData', 'reviews'),
            'highlights' => [
                'save' => route($this->route_prefix . 'update-trip', 'highlights'),
                'delete' => route($this->route_prefix . 'deleteData', 'highlights'),
            ],
            'dates' => [
                'save' => route($this->route_prefix . 'update-trip', 'dates'),
                'delete' => route($this->route_prefix . 'deleteData', 'dates'),
            ],
            'faqs' => [
                'save' => route($this->route_prefix . 'update-trip', 'faqs'),
                'delete' => route($this->route_prefix . 'deleteData', 'faqs'),
            ],
        ];
    }

    protected function getMedias($item): void
    {
        $this->medias = [
            'pic' => [
                'src' => $item->medias()['pic'] ?? asset('images/no-image.webp'),
                'alt' => 'trip-main-pic',
                'form_data' => $this->pic,
            ],
            'hero' => [
                'src' => $item->medias()['hero'] ?? asset('images/no-image.webp'),
                'alt' => 'trip-hero-image',
                'form_data' => $this->hero,
            ],
            'photos' => [
                'files' => $item->parsedPhotos(),
                'form_data' => [
                    'theItem_id' => $item->id,
                    'name' => 'Trip_' . $item->id . ' gallery photos',
                    'data_media' => 'photos',
                ]
            ],
        ];
    }
}
