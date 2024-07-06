<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductCard extends Component
{
    public $title;
    public $img;
    public $id;
    public $price;

    /**
     * Create a new component instance.
     */
    public function __construct($id, $title , $price,  $img)
    {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->img = $img;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ProductCard');
    }
}
