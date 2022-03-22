<?php


namespace App\Models\Graphs;


class Doughnut extends _Graph
{

    public $column;
    public $nbCols;

    /**
     * Timeline constructor.
     */
    public function __construct()
    {
        parent::__construct('doughnut');
        $this->column = null;
        $this->nbCols = '4';
    }
}
