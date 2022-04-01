<?php


namespace App\Models;


use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Monolog\Logger;

class Sheet
{
    public $url;
    public $rowTitle;
    public $columnDuration;
    public $totalDuration;
    public $columnDescription;
    public $activities;
    public $sheet;
    public $refs;
    public $cols;
    public $start;
    public $end;

    /**
     * Sheet constructor.
     * @param $url
     * @param $rowTitle
     */
    public function __construct($url, $rowTitle,$columnDescription,$columnDuration,$start=null,$end=null)
    {
        $this->url = $url;
        $this->rowTitle = $rowTitle;
        $this->columnDuration=$columnDuration;
        $this->totalDuration=0;
        $this->columnDescription=$columnDescription;
        $this->parseCSV();
        $this->cols=$this->sheet[$this->rowTitle];
        if($this->columnDuration!==null){
            $this->refs = $this->distinct(0,true);
            $this->activities=[];
            $this->start = $start;
            $this->end=$end;
            $this->setActivities();
        }
    }

    public function distinct($column,$valueInKey=false,$start=null,$end=null){
        return $this->values($column,$valueInKey,$start,$end,true);
    }

    public function values($column,$valueInKey=false,$start=null,$end=null,$distinct=false)
    {
        $values = [];

        for($i=$this->rowTitle+1;$i<count($this->sheet);$i++) {
            $row = $this->sheet[$i];
            if($row[$this->columnDuration]>0 and ($start==null or $start<=$row[0]) and ($end==null or $row[0]<=$end)){
                if (!$distinct or in_array($row[$column], $values)===false) {
                    if ($valueInKey) {
                        $values[$row[$column]] = $row[$column];
                    } else {
                        $values[] = $row[$column];
                    }
                }
            }
        }
        sort($values);
        return $values;
    }

    public function getActivities($refStart=null, $refEnd=null)
    {
        $activities=[];
        if(null!==$this->columnDuration and null!==$this->columnDescription) {
            $start = 0;
            for ($i = $this->rowTitle + 1; $i < count($this->sheet); $i++) {
                $row = $this->sheet[$i];
                if ($row[$this->columnDuration] > 0 and (($refStart==null or $refStart<=$row[0]) and ($refEnd==null or $row[0]<=$refEnd))) {
                    $activities[] = new Activity($row[0], $row[$this->columnDescription], $row[$this->columnDuration], $start, $row);
                    $start+=floatval($row[$this->columnDuration]);
                }
            }
            if($start>0) {
                $this->totalDuration = $activities[count($activities) - 1]->end;
            }
        }
        return $activities;

    }

    private function setActivities(){
        //activities
        $this->activities = $this->getActivities($this->start,$this->end);
    }

    public function parseCSV()
    {
        $id = md5($this->url);
        Storage::put($id,file_get_contents($this->url));
        $this->sheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(Storage::path($id))->getSheet(0)->toArray();
        Storage::delete($id);
        if(null==$this->sheet){
            return view('dashboard',['message'=>'Votre tableur n\'est pas lisible, avez-vous <a href="https://support.google.com/a/users/answer/9308873?hl=fr" target="_blank"> partagé publiquement votre document</a> ?']);
        }
    }




}
