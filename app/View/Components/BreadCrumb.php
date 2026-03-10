<?php

namespace App\View\Components;

use App\Models\PageBanner;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class BreadCrumb extends Component
{
    public $pageBanner;
    public $mainTitle;
    public $pageName;

   public function __construct($mainTitle = '', $pageName = '')
{
    $this->mainTitle = $this->limitWords($mainTitle, 3);
    $this->pageName = $pageName;

    $banner = PageBanner::where('page', 'all')->first();

    $this->pageBanner = $banner && $banner->image
        ? $banner->image
        : 'template/yatri_world/main-file/images/tibet_vertical.jpg';
}

private function limitWords($text, $limit = 3)
{
    return Str::words($text, $limit, '...');
}


    public function render(): View|Closure|string
    {
        return view('components.bread-crumb', [
            'pageBanner' => $this->pageBanner,
            'mainTitle' => $this->mainTitle,
            'pageName' => $this->pageName,
        ]);
    }
}
