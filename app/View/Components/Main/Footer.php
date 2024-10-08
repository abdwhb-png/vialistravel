<?php

namespace App\View\Components\Main;

use Closure;
use App\Models\Region;
use App\Models\Interest;
use App\Models\SitePage;
use App\Models\LegalPage;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class Footer extends Component
{
    public array $interests;
    public array $regions;
    public array $aboutUs;
    public array $travelerResources;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->getInterests();
        $this->getRegions();
        $this->travelerResources = [
            ['title' => 'Frequently Asked Questions', 'route' => route('faqs')],
            ['title' => 'Sitemap', 'route' => '/sitemap'],
        ];
        $this->aboutUs = [
            ['title' => 'Our Trips', 'route' =>  route('our-trips')],
            ['title' => 'Contact Us', 'route' => route('contact-us')],
            ['title' => 'Awards', 'route' => 'awards-media-press'],
        ];
        $this->getaboutUs();
        $this->getTravelerResources();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.main.footer');
    }

    protected function getInterests(): void
    {
        foreach (Interest::all() as $item) {
            $this->interests[] = [
                'title' => $item->title,
                'route' => route('our-trips', ['interest' => $item->permalink]),
            ];
        }
    }

    protected function getRegions(): void
    {
        foreach (Region::all() as $item) {
            $this->regions[] = [
                'title' => $item->title,
                'route' => route('region', $item->permalink),
            ];
        }
    }

    protected function getaboutUs(): void
    {
        foreach (SitePage::where('menu_section', 'our-story')->get() as $item) {
            $this->aboutUs[] =
                [
                    'title' => $item->name,
                    'route' => $item->permalink,
                ];
        }
    }

    protected function getTravelerResources(): void
    {
        foreach (SitePage::where('menu_section', 'traveler-resources')->get() as $item) {
            $this->travelerResources[] = [
                'title' => $item->name,
                'route' => $item->permalink,
            ];
        }
        foreach (LegalPage::all() as $item) {
            $this->travelerResources[] = [
                'title' => $item->name,
                'route' => $item->permalink,
            ];
        }
    }
}