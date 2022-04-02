<?php

namespace App\View\Components;

use App\Models\Data;
use Illuminate\View\Component;

class Blank extends Component
{
    public $graph;
    public $title ;
    public $data;
    public $sheet;
    public $readonly;

     /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($graph=false,$data=null,$sheet=null,$title='',$readonly=false)
    {
        $this->graph=$graph;
        $this->title=$title;
        $this->data=$data;
        $this->sheet=$sheet;
        $this->readonly=$readonly;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.blank');
    }
}
