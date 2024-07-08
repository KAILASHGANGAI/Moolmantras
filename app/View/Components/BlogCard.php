<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class BlogCard extends Component
{
    public $title;
    public $slug;
    public $img;
    public $publishDate;
    public $description;
    public $viewCount;
    /**
     * Create a new component instance.
     */
    public function __construct(
        $title,
        $slug,
        $img,
        $publishDate,
        $description,
        $viewCount
    ) {
        $this->title = $title;
        $this->slug = $slug;
        $this->img = $img;
        $this->publishDate = $publishDate;
        $this->description = $description;
        $this->viewCount = $viewCount;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.blog-card');
    }
}
