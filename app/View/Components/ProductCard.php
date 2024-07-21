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
    public $sprice;
    public $cprice;
    public $itemSpecific;
    public $category;

    /**
     * Create a new component instance.
     */
    public function __construct($id, $title , $cprice ,$sprice,  $img, $itemSpecific, $category)
    {
        $this->id = $id;
        $this->title = $title;
        $this->cprice = $cprice;
        $this->sprice = $sprice;
        $this->img = $img;
        $this->itemSpecific = $itemSpecific;
        $this->category = $category;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ProductCard');
    }
}
