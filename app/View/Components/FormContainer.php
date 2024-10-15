<?php
namespace App\View\Components;
use Illuminate\View\Component;
class FormContainer extends Component {

public $title;
public $description;
/**
 * Create a new component instance.
 * @return void
 */
public function __construct($title = '', $description = '', $form = '') {
//
$this->title = $title;
$this->description = $description;

}

/**
 * Get the view / contents that represent the component.
 * @return \Illuminate\View\View|string
 */

public function render() {
return view('components.atoms.form-container');
}
}

