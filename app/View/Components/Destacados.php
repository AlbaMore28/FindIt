<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Destacados extends Component
{
    public $objetos;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($objetos)
    {
        
        //$objetos = explode('\n', $objetos);
        $this->objetos =  $objetos;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.destacados');
    }
}
