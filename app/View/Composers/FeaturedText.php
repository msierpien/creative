<?php

// namespace App\View\Components;
namespace App\View\Composers;
use Illuminate\View\Component;




class FeaturedText extends Component
{
    public $sectionTitle;
    public $sectionDescription;
    public $items; 

 
    public function __construct($sectionTitle = '', $sectionDescription = '', array $items = [])
    {
        $this->sectionTitle = $sectionTitle;
        $this->sectionDescription = $sectionDescription;
        $this->items = $items; 
    }

    public function render()
    {
        return view('components.module.featured-text', [
            'items' => $this->items, 
        ]);
    }
}