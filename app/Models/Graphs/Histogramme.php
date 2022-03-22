<?php


namespace App\Models\Graphs;


class Histogramme extends _Graph
{
    public $columns;
    /**
     * Timeline constructor.
     */
    public function __construct()
    {
        parent::__construct('histogramme');
        $this->columns=[];
    }
}
