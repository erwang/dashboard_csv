<?php


namespace App\Models\Graphs;


class Timeline extends _Graph
{


    public $column1;
    /**
     * Timeline constructor.
     */
    public function __construct()
    {
        parent::__construct('timeline');
        $this->column1=null;
        $this->column2=null;
        $this->column3=null;
    }
}
