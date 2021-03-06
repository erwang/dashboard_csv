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
    public $graph;
    public $lines;
    public $timeIntervalLines;
    public $readonly;

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
    public function __construct($sheet,$graph,$readonly=false)
    {
        $this->margin=5;
        $this->sheet = $sheet;
        $this->readonly = $readonly;
        $this->graph  = $graph;
        $this->lines=[];
        $this->timeIntervalLines=[];
        //get all distinct values from first column
        $y=$this->margin*2;$i=0;

        if(null!==$graph->column1) {
            $values =$this->sheet->distinct($graph->column1, false, $graph->start, $graph->end);
            sort($values);
            foreach ($values as $value) {
                $this->lines[$value] = new TimelineLine($y, $value, Colors::COLORS[0][$i % 8]);
                $y += $this->lineHeight;
                $i++;
            }
            //get all distinct values from second column
            $this->distinctValuesColumn2 = [];
            $i = 0;
            if (isset($graph->column2) and $graph->column2 != '') {
                foreach ($this->sheet->distinct($graph->column2, false, $graph->start, $graph->end) as $value) {
                    $this->distinctValuesColumn2[$value] = Colors::COLORS[1][$i];
                    $i++;
                }
            }
            //get all distinct values from third column
            $this->distinctValuesColumn3 = [];
            $i = 0;

            if (isset($graph->column3) and $graph->column3 != '') {
                foreach ($this->sheet->distinct($graph->column3, false, $graph->start, $graph->end) as $value) {
                    $this->distinctValuesColumn3[$value] = Colors::COLORS[2][$i];
                    $i++;
                }
            }

            $this->height = $y + max(count($this->distinctValuesColumn2), count($this->distinctValuesColumn3)) * ($this->lineHeight) + 50;
            $lineLength = $this->width - 2 * $this->margin - $this->startLine;
            //create lines
            foreach ($this->sheet->getActivities($graph->start, $graph->end) as $activity) {
                if (isset($graph->column3) and isset($this->distinctValuesColumn3[$activity->data[$graph->column3]])) {
                    $this->lines[$activity->data[$graph->column1]]->addArea(
                        $activity->start * $lineLength / $sheet->totalDuration + $this->margin + $this->margin,
                        $activity->duration * $lineLength / $sheet->totalDuration,
                        '',
                        $this->distinctValuesColumn3[$activity->data[$graph->column3]],
                        '', -$this->margin
                    );
                }
                if (isset($graph->column2) and isset($this->distinctValuesColumn2[$activity->data[$graph->column2]])) {
                    $color = $this->distinctValuesColumn2[$activity->data[$graph->column2]];
                } else {
                    try {
                        $color = $this->lines[$activity->data[$graph->column1]]->color;
                    } catch (\Exception $e) {
                        var_dump($e->getMessage());
                        var_dump($activity);
                        var_dump($e->getMessage());
                        var_dump($graph->column1);
                        var_dump($graph->column2);
                        var_dump($this->lines);
                        dd($activity->data);
                    }
                }
                $this->lines[$activity->data[$graph->column1]]->addArea(
                    $activity->start * $lineLength / $sheet->totalDuration + $this->margin,
                    $activity->duration * $lineLength / $sheet->totalDuration,
                    $activity->ref,
                    $color,
                    $activity->description
                );
            }
            //creation des lignes intervalles de temps
            if(isset($this->graph->timeInterval) and $this->graph->timeInterval!=='' and $this->graph->timeInterval>0){
                $time = 0;
                while($time<$sheet->totalDuration){
                    $time+=$this->graph->timeInterval;
                    $this->timeIntervalLines[]=[
                        'x'=>$this->startLine+$time*$lineLength / $sheet->totalDuration + $this->margin,
                        'yMax'=>count($this->lines) * ($this->lineHeight+1)+$this->margin*3,
                        'time'=>$time,

                    ];
                }
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.graph.timeline',['data'=>$this->graph]);
    }
}
