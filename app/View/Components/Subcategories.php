<?php

namespace App\View\Components;
use Illuminate\View\Component;




class Subcategories extends Component
{
    public $categoryId;
    public $subcategories;

    /**
     * Create the component instance.
     *
     * @param  int  $categoryId
     * @return void
     */
    public function __construct($categoryId)
    {
        $this->categoryId = $categoryId;
        $this->subcategories = get_terms([
            'taxonomy' => 'product_cat',
            'hide_empty' => false,
            'parent' => $this->categoryId,
        ]);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.subcategories');
    }
}