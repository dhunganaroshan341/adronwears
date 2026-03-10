<?php
namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TeamSection extends Component
{
    public $members;
    public $title;

    /**
     * Create a new component instance.
     */
    public function __construct($members, $title = 'Our Team')
    {
        $this->members = $members;
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.team-section');
    }
}
