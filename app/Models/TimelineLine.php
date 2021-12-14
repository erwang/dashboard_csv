<?php


namespace App\Models;


class TimelineLine
{
    public $y;
    public $text;
    public $areas;
    public $color;

    public function __construct($y,$text,$color)
    {
        $this->y=$y;
        $this->text=$text;
        $this->color=$color;
        $this->areas=collect();
    }

    public function addArea($x,$width,$text,$color,$description='',$dy=0)
    {
        $this->areas->add([
           'x'=>$x,
           'y'=>$this->y+$dy,
           'width'=>$width,
           'text'=>$text,
           'color'=>$color,
           'description'=>$description
        ]);
    }
}
