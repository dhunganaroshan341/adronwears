<?php

namespace App\View\Components;

use App\Models\Notice;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PopupNotice extends Component
{
    /**
     * Create a new component instance.
     */
    protected $popupNotice;
    public function __construct()
    {
        //
        $this->popupNotice = Notice::latest()->first();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.popup-notice',[
            'popupNotice'=>$this->popupNotice
        ]);
    }
}
