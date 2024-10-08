<?php

namespace App\View\Components\Admin;

use App\Models\SocialLink;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class SocialLinks extends Component
{
    public Collection $links;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->links = SocialLink::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin.social-links');
    }
}