<?php

namespace App\View\Components\Graph;

use App\Models\Colors;
use Illuminate\View\Component;

class Histogramme extends Component
{
    public $sheet;
    public $graph;
    public $width='1066';
    public $startLine=100;
    public $height;
    public $title='Histogramme';
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
        $this->sheet = $sheet;
        $this->graph  = $graph;
        $this->readonly = $readonly;

        $this->labels = [];
        $this->datasets = [];

        $graph->start = $graph->start ?? $sheet->start;
        $graph->end = $graph->end ?? $sheet->end;
        //creation des labels pour l'axe X
        $this->labels = $sheet->values(0, false, $graph->start, $graph->end);


        //creation des labels des lignes
        $i=0;
        foreach($graph->columns as $column){
            $this->datasets[$column]=new \stdClass();
            $this->datasets[$column]->label=$sheet->cols[$column];
            $this->datasets[$column]->borderColor = Colors::COLORS[0][$i];
            $this->datasets[$column]->backgroundColor = Colors::COLORS[0][$i];
            $this->datasets[$column]->tension = 0.2;
            $this->datasets[$column]->borderWidth = 5;
            //TODO changer couleurs
            //TODO définir x en fonction de la durée de l'activité
//            $this->datasets[$column]->stepped = true;
            $i++;
        }
        //remplissage des datas
        foreach($graph->columns as $column) {
            $this->datasets[$column]->data=[];
            foreach ($this->sheet->values($column, false, $graph->start, $graph->end) as $value) {
                $this->datasets[$column]->data[]=$value;
            }
        }
//        dd($this->sheet);
        //dd($this->datasets);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.graph.histogramme');
    }
}
