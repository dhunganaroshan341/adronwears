<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Page; // Make sure the correct Page model namespace is used

class HomeAboutUsSection extends Component
{
    public $homeAboutContent;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        // Fetch page with slug 'home_about'
        $this->homeAboutContent = Page::where('slug', 'home_about')->first();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.home-about-us-section', [
            'homeAboutContent' => $this->homeAboutContent
        ]);
    }
}
