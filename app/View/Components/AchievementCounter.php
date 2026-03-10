<?php

namespace App\View\Components;

use Closure;
use App\Models\Achievement;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AchievementCounter extends Component
{
    public $achievements;

    public function __construct()
    {
       $achievements = Achievement::where('status', 'Active')
                           ->orderBy('created_at', 'desc')
                           ->take(4)
                           ->get();
 $achievements = Achievement::where('status','Active')->take(4)->get();

        // Optional fallback logic if not enough achievements
        if ($achievements->isEmpty()) {
            $achievements = collect([
                (object)[ 'count' => 1000, 'title' => 'Happy Customers', 'icon_class' => 'fas fa-smile' ],
                (object)[ 'count' => 200, 'title' => 'Amazing Tours', 'icon_class' => 'fas fa-plane' ],
                (object)[ 'count' => 20, 'title' => 'Years In Business', 'icon_class' => 'fas fa-clock' ],
                (object)[ 'count' => 523, 'title' => 'Support Case', 'icon_class' => 'fas fa-headset' ],
            ]);
        }

        $this->achievements = $achievements;
    }

    public function render(): View|Closure|string
    {
        return view('components.achievement-counter');
    }
}
