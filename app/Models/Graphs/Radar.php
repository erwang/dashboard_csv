<?php


namespace App\Models\Graphs;


class Radar extends _Graph
{

    public $column;
    public $nbCols;

    /**
     * Timeline constructor.
     */
    public function __construct()
    {
        parent::__construct('radar');
        $this->column = null;
        $this->nbCols = '2';
    }
}
