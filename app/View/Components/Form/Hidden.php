<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class Hidden extends Component
{
    public $name;
    public $value;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name,$value)
    {
        $this->name=$name;
        $this->value=$value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.hidden');
    }
}
