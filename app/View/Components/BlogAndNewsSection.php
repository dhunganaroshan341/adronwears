<?php


namespace App\View\Components;

use App\Models\Post;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BlogAndNewsSection extends Component
{
    public $posts;

   public function __construct()
{
   $this->posts = Post::with(['postImages', 'categories'])
    ->where('status', 'Active')
    ->whereNotNull('slug')
    ->where('slug', '!=', '')
    ->latest()
    ->limit(5)
    ->get();


}


    public function render(): View|Closure|string
    {
        return view('components.blog-and-news-section');
    }
}
