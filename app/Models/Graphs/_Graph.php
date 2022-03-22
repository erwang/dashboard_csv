<?php


namespace App\Models\Graphs;
use Illuminate\Support\Str;

class _Graph
{
    public $type;
    public $uuid;
    public $start=null;
    public $end=null;

    /**
     * _Graph constructor.
     * @param $type
     * @param $uuid
     */
    public function __construct($type)
    {
        $this->type = $type;
        $this->uuid = Str::uuid();
    }

    public static function create($type)
    {
        switch($type)
        {
            case 'timeline':
                return new Timeline();
            case 'histogramme':
                return new Histogramme();
            case 'doughnut':
                return new Doughnut();
        }


    }


}
