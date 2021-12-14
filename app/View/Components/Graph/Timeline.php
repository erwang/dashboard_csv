<?php

namespace App\View\Components\Graph;

use App\Models\Colors;
use App\Models\TimelineLine;
use Illuminate\Support\Facades\Log;
use Illuminate\View\Component;
use Monolog\Logger;

class Timeline extends Component
{

    public $sheet;
    public $data;
    public $lines;
    public $margin;
    public $width='1066';
    public $startLine=100;
    public $height;
    public $lineHeight=40;
    public $distinctValuesColumn2;
    public $distinctValuesColumn3;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($sheet,$data)
    {
        $this->margin=5;
        $this->sheet = $sheet;
        $this->data  = $data;
        $this->lines=[];
        //get all distinct values from first column
        $y=$this->margin*2;$i=0;
        foreach ($this->sheet->distinct($data['column1']) as $value) {
            $this->lines[$value]=new TimelineLine($y,$value,Colors::COLORS[0][$i]);
            $y+=$this->lineHeight;
            $i++;
        }

        //get all distinct values from second column
        $this->distinctValuesColumn2=[];
        $i=0;
        if(isset($data['column2']) and $data['column2']!='') {
            foreach ($this->sheet->distinct($data['column2']) as $value) {
                $this->distinctValuesColumn2[$value] = Colors::COLORS[1][$i];
                $i++;
            }
        }
        //get all distinct values from second column
        $this->distinctValuesColumn3=[];
        $i=0;
        if(isset($data['column3']) and $data['column3']!='') {
            foreach ($this->sheet->distinct($data['column3']) as $value) {
                $this->distinctValuesColumn3[$value] = Colors::COLORS[2][$i];
                $i++;
            }
        }

        $this->height=$y+max(count($this->distinctValuesColumn2),count($this->distinctValuesColumn3))*($this->lineHeight)+50;
        $lineLength = $this->width-2*$this->margin-$this->startLine;
        //create lines
        foreach ($this->sheet->activities as $activity) {
            if(isset($data['column3']) and isset($this->distinctValuesColumn3[$activity->data[$data['column3']]])) {
                $this->lines[$activity->data[$data['column1']]]->addArea(
                    $activity->start*$lineLength/$sheet->totalDuration+$this->margin+$this->margin,
                    $activity->duration*$lineLength/$sheet->totalDuration,
                    '',
                    $this->distinctValuesColumn3[$activity->data[$data['column3']]],
                    '',-$this->margin
                );
            }
            if(isset($data['column2']) and isset($this->distinctValuesColumn2[$activity->data[$data['column2']]])){
                $color = $this->distinctValuesColumn2[$activity->data[$data['column2']]];
            }else {
                $color = $this->lines[$activity->data[$data['column1']]]->color;
            }
            $this->lines[$activity->data[$data['column1']]]->addArea(
                $activity->start*$lineLength/$sheet->totalDuration+$this->margin,
                $activity->duration*$lineLength/$sheet->totalDuration,
                $activity->ref,
                $color,
                $activity->description
            );
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.graph.timeline',['data'=>$this->data]);
    }
}
