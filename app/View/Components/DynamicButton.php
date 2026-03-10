<?php

namespace App\View\Components;

use Illuminate\View\Component;

class DynamicButton extends Component
{
    public $text;
    public $route;

    public function __construct($text, $route)
    {
        $this->text = $text;
        $this->route = $route;
    }

    public function render()
    {
        return view('components.dynamic-button');
    }
}
