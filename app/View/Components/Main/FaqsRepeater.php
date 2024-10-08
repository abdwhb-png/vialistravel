<?php

namespace App\View\Components\Main;

use Closure;
use App\Models\Faq;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;

class FaqsRepeater extends Component
{
    public Collection $faqs;
    /**
     * Create a new component instance.
     */
    public function __construct(
        $faqs = null
    ) {
        $this->faqs = $faqs ?? Faq::all();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.main.faqs-repeater');
    }
}
