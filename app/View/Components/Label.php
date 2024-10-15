<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Label extends Component
{
    public $for;
    public $text;
    public $styleClasses;

    public function __construct($for = '', $text = '', $style = 'default')
    {
        $this->for = $for;
        $this->text = $text;

        // Definicja stylów na podstawie wartości przekazanej do parametru $style
        $styles = [
            'default' => 'mb-4 text-gray-60 font-thin',
            'black' => 'mb-4 text-black font-thin',
            'red' => 'mb-2 text-red',
        ];

        // Przypisanie klas Tailwind CSS na podstawie wybranego stylu
        $this->styleClasses = $styles[$style] ?? $styles['default'];  // domyślnie 'default'
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.atoms.label');
    }
}
