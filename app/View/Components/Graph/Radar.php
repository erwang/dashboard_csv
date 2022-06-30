<?php

namespace App\View\Components\Graph;

use App\Models\Colors;
use Illuminate\View\Component;

class Radar extends Component
{
    public $sheet;
    public $graph;
    public $labels;
    public $datasets;
    public $readonly;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($sheet,$graph,$readonly=false)
    {
        $this->sheet=$sheet;
        $this->graph=$graph;
        $this->readonly = $readonly;
        $this->labels = [];
        $this->datasets = [];

        $this->labels = $sheet->distinct($graph->column ?? 0, false, $graph->start, $graph->end);
        $graph->start = $graph->start ?? $sheet->start;
        $graph->end = $graph->end ?? $sheet->end;

        $this->datasets[0]=new \stdClass();
        $this->datasets[0]->data = [];
        $this->datasets[0]->backgroundColor = [];
        //creation des labels des lignes
        $i=0;
        $data=[];

        if(null != $graph->column) {
            $this->datasets[0]->label = $sheet->cols[$graph->column];
            if(null!=$graph->start or null!=$graph->end) {
                $this->datasets[0]->label .=' (' . $graph->start . ' - ' . $graph->end . ')';
            }
            //TODO ajouter ->
            $this->datasets[0]->tension = 0.2;

            foreach ($this->labels as $label) {
//                $this->datasets[0]->borderColor = Colors::COLORS[0][$i % count(Colors::COLORS[0])];
                $this->datasets[0]->backgroundColor[] = Colors::COLORS[4][$i % count(Colors::COLORS[0])];
                $data[$label] = 0;
                $i++;
            }

            foreach ($this->sheet->getActivities($graph->start, $graph->end) as $activity) {
                $data[$activity->data[$graph->column]] += $activity->duration;
            }
            foreach ($this->labels as $label) {
                $this->datasets[0]->data[] = $data[$label];
            }
        }
        //TODO alleger les scales text ou les enlever
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.graph.radar');
    }
}
