<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Input extends Component
{
    public $name;
    public $id;
    public $type;
    public $value;
    public $placeholder;
    public $autocomplete;
    public $required;
    public $ariaRequired;
    public $styleClasses;

    public function __construct(
        $name = '', 
        $id = '', 
        $type = 'text', 
        $value = '', 
        $placeholder = '', 
        $autocomplete = '', 
        $required = false, 
        $ariaRequired = false, 
        $style = 'default'
    ) {
        $this->name = $name;
        $this->id = $id;
        $this->type = $type;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->autocomplete = $autocomplete;
        $this->required = $required;
        $this->ariaRequired = $ariaRequired;

        // Definicja stylów na podstawie wartości przekazanej do parametru $style
        $styles = [
            'default' => 'block w-full border border-gray-300 text-gray-900 bg-white p-2',
            'black' => 'block w-full border border-black text-black bg-white p-2',
            'red' => 'block w-full border border-red-500 text-red-700 bg-red-50 p-2',
            'checkbox' => 'h-4 w-4 mr-2 rounded border-gray-300 text-black focus:ring-gray-50',
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
        return view('components.atoms.input');
    }
}
