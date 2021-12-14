<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;

class Settings extends Component
{
    public $title;
    public $sheet;
    public $data;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($sheet)
    {
        $this->title=__('Settings');
        $this->data=Session::get('data')??[];
        $this->sheet=$sheet;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.settings',['data'=>$this->data]);
    }
}
