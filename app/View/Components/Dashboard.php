<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Log;
use Illuminate\View\Component;

class Dashboard extends Component
{
    public $title;
    public $data;
    public $sheet;
    public $readonly;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($data=[],$sheet=null,$readonly=false,$messages=[])
    {
        $this->data=$data;
        $this->sheet=$sheet;
        $this->readonly=$readonly;
        $this->title=__('Dashboard');
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.dashboard',['data'=>$this->data]);
    }
}
