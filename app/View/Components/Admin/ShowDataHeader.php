<?php

namespace App\View\Components\Admin;

use Closure;
use Illuminate\Support\Str;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class ShowDataHeader extends Component
{
    public array $images;
    public string $text = '';
    public string $dataDialog;
    public array $tabs = ['basics', 'more', 'medias'];

    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $type,
        public $item,
        public string $deleteRoute,
        string $hero = null,
        string $pic = null,
    ) {
        $this->dataDialog = 'Are you sure to delete this record : ' . $item->title . ' ?';
        $this->images['hero'] = $hero ?? asset('images/show-data-header-bg.jpg');
        $this->images['pic'] = $pic ?? asset('images/no-image.webp');

        $this->parseTabs();
        $this->getImages($item);
        $this->getText($item);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.show-data-header');
    }

    protected function parseTabs(): void
    {
        $tabs = [];
        if ($this->type == 'trips') {
            $this->tabs = [
                'basic-informations',
                'overview-and-itinerary',
                'highlights-dates-and-faqs',
                'more-details-and-reviews',
                'medias',
            ];
        }
        if ($this->type == 'regions') {
            $this->tabs = [
                'basic-informations',
                'interests-and-wildlives',
                'medias',
            ];
        }

        foreach ($this->tabs as $tab) {
            $tabs[] = [Str::title(str_replace('-', ' ', $tab)), '#' . $tab];
        }
        $this->tabs = $tabs;
    }

    protected function getImages($item): void
    {
        if (in_array($this->type, ['regions', 'trips'])) {
            $this->images['pic'] = $item->medias()['pic'];
            $this->images['hero'] = $item->medias()['hero'];
        }
    }

    protected function getText($item): void
    {
        $text = '';
        if ($this->type == 'regions') {
            $text = ($item->countries ? $item->countries->count() : 0) . ' countries, ' .
                ($item->trips ? $item->trips->count() : 0) . ' trips, ' .
                ($item->interests ? $item->interests->count() : 0) . ' interests, ' .
                ($item->wildlives ? $item->wildlives->count() : 0) . ' wildlives';
        }
        if (in_array($this->type, ['countries', 'trips'])) {
            $this->images['pic'] = $item->medias()['pic'];
            $this->images['hero'] = $item->medias()['hero'];

            $text = 'Take place in ';
            if ($item->region) {
                $text = $text . 'the "<a href="/data/regions/' . $item->region->id . '" class="text-primary"><u>' . $item->region->title . '</u></a>" region.';
            } else {
                $text = $text . '<span class="text-danger">NO REGION ATTRIBUED</span>';
            }
        }

        if (in_array($this->type, ['interests', 'wildlives'])) {
            $text = "Bounded regions : ";
            if ($item->regions) {
                foreach ($item->regions as $r) {
                    $text = $text . $r->title . ' ,';
                }
            } else {
                $text = $text . '<span class="text-danger">NO REGION ATTRIBUED</span>';
            }
        }

        $this->text = $text;
    }
}