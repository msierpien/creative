<?php

namespace App\View\Composers;

use Illuminate\View\Component;

class Button extends Component

{
    public $name;
    public $link;
    public $target;

    /**
     * Create the component instance.
     *
     * @param string $name
     * @param string $link
     * @param string $target
     */
    public function __construct($name = 'Button', $link = '#', $target = '_self')
    {
        $this->name = $name;
        $this->link = $link;
        $this->target = $target;

    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return $this->view('components.atoms.button');
    }
}