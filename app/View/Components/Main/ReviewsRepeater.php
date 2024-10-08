<?php

namespace App\View\Components\Main;

use App\Models\Review;
use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;

class ReviewsRepeater extends Component
{
    public Collection $reviews;
    /**
     * Create a new component instance.
     */
    public function __construct(
        $reviews = null,
        public string $title = ""
    ) {
        $this->reviews = $reviews ?? Review::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.main.reviews-repeater');
    }
}
