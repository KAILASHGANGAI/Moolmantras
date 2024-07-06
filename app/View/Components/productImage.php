<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class productImage extends Component
{
    public $title;
    public $img;
    /**
     * Create a new component instance.
     */
    public function __construct($title , $img)
    {
            $this->title = $title;
            $this->img = $img;    
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.productImage');
    }
}
