<?php

namespace App\View\Components;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\View\Component;


class File extends Component
{
    public $title;
    public $data;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->title=__('File');
        $this->data=Session::get('data')??[];
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.file',['data'=>$this->data]);
    }
}
