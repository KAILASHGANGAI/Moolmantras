<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CategoryCard extends Component
{
    public $title;
    public $id;
    public $img;

    /**
     * Create a new component instance.
     */
    public function __construct($id , $title , $img)
    {
        $this->id = $id;
        $this->title = $title;
        $this->img = $img;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.category-card');
    }
}
