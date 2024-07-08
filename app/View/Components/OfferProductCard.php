<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class OfferProductCard extends Component
{
    public $title;
    public $img;
    public $id;
    public $cprice;
    public $sprice;
    public $discount;
public $category;
    /**
     * Create a new component instance.
     */
    public function __construct($id, $title , $sprice,$cprice,  $img, $discount, $category)
    {
        $this->id = $id;
        $this->title = $title;
        $this->sprice = $sprice;
        $this->cprice = $cprice;
        $this->img = $img;
        $this->discount = $discount;
        $this->category = $category;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.offer-product-card');
    }
}
