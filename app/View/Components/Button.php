<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Button extends Component
{
    public $name;
    public $title;
    public $value;
    public $type;
    public $styleClasses;

    public function __construct($name = 'Button', $title = 'Button', $value = 'Button', $type = 'button', $style = 'black')
    {
        $this->name = $name;
        $this->title = $title;
        $this->value = $value;
        $this->type = $type;

        // Definicja stylów na podstawie wartości przekazanej do parametru $style
        $styles = [
            'black' => 'bg-black text-white hover:bg-gray-80',
            'white' => 'bg-white text-black border border-black hover:bg-gray-10',
            'red' => 'bg-red text-white hover:bg-red/50',
        ];

        // Przypisanie klas Tailwind CSS na podstawie wybranego stylu
        $this->styleClasses = $styles[$style] ?? $styles['black'];  // domyślnie black
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('components.atoms.button');
    }
}
