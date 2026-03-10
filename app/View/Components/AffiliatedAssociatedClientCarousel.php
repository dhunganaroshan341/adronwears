<?php
namespace App\View\Components;

use App\Models\Client;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AffiliatedAssociatedClientCarousel extends Component
{
    public $clients;
    public $title;

    /**
     * @param string $type The client type (associate/affiliated)
     * @param string $title The carousel heading/title
     */
    public function __construct($type = 'associate', $title = null)
    {
        $this->clients = Client::where('status', 'active')
                               ->where('type', $type)
                               ->get();

        // If no title passed, default to capitalized type
        $this->title = $title ?? ucfirst($type);
    }

    public function render(): View|Closure|string
    {
        return view('components.client-carousel');
    }
}
