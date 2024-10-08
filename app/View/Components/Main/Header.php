<?php

namespace App\View\Components\Main;

use App\Models\Region;
use App\Models\SitePage;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class Header extends Component
{
    public array $images;
    public array $sitePages;
    public Collection $regions;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $sections = config('vars.menu_sections');
        $this->regions = Region::all();
        $this->getPages($sections);
        $this->getImages($sections);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.main.header');
    }

    protected function getPages(array $sections): void
    {
        $this->sitePages['our-story'] = [];
        $this->sitePages['traveler-resources'] = [];

        $this->sitePages['conservation'] = [
            [
                'title' => 'Quality & Value Guarantee',
                'route' => '/quality-value-guarantee',
            ],
            [
                'title' => 'Carbon-Neutral Travel',
                'route' => '/carbon-neutral-travel',
            ],
            [
                'title' => 'Reduicing Waste',
                'route' => '/reduicing-waste',
            ],
        ];

        $this->sitePages['more'] = [
            [
                'title' => 'Contact Us',
                'route' => '/contact',
            ],
            [
                'title' => 'Awards Media & Press',
                'route' => '/awards-media-press',
            ],
        ];

        foreach ($sections as $section) {
            foreach (SitePage::where('menu_section', $section)->get() as $item) {
                $this->sitePages[$section][] =
                    [
                        'title' => $item->name,
                        'route' => $item->permalink,
                    ];
            }
        }
    }

    protected function getImages(array $sections): void
    {
        foreach ($sections as $section) {
            $this->images[$section] = asset('assets/images/menu-sections/' . $section . '.jpg');
        }
    }
}