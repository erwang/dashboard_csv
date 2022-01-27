<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Card extends Component
{
    public $title;
    public $tools;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title='',$tools=false)
    {
        $this->title=$title;
        $this->tools=$tools;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.card');
    }
}
