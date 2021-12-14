<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class SelectRow extends Component
{

    public $name;
    public $value;
    public $label;
    public $options;
    public $empty;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name,$label,$options,$value=null,$empty=false)
    {
        $this->name=$name;
        $this->value=$value;
        $this->label=$label;
        $this->options=$options;
        $this->empty=$empty;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.select-row');
    }
}
