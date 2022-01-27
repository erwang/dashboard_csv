<?php


namespace App\Models;


use Illuminate\Support\Facades\Log;
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

    public function distinct($column,$valueInKey=false){
        $values = [];
        for($i=$this->rowTitle+1;$i<count($this->sheet);$i++) {
            $row = $this->sheet[$i];
            if($row[$this->columnDuration]>0 and ($this->start==null or $this->start<=$row[0]) and ($this->end==null or $row[0]<=$this->end)){
                if (!in_array($row[$column], $values)) {
                    if ($valueInKey) {
                        $values[$row[$column]] = $row[$column];
                    } else {
                        $values[] = $row[$column];
                    }
                }
            }
        }
        return $values;
    }

    private function setActivities(){
        //activities
        if(null!==$this->columnDuration and null!==$this->columnDescription) {
            $start = 0;
            for ($i = $this->rowTitle + 1; $i < count($this->sheet); $i++) {
                $row = $this->sheet[$i];
                if ($row[$this->columnDuration] > 0 and (($this->start==null or $this->start<=$row[0]) and ($this->end==null or $row[0]<=$this->end))) {
                    $this->activities[] = new Activity($row[0], $row[$this->columnDescription], $row[$this->columnDuration], $start, $row);
                    $start+=floatval($row[$this->columnDuration]);
                }
            }
            if($start>0) {
                $this->totalDuration = $this->activities[count($this->activities) - 1]->end;
            }
        }
    }

    public function parseCSV()
    {
        $id=md5($this->url);

        if(!Storage::exists($id) or time()-Storage::lastModified($id)>360) {
            try{
                Log::debug('Téléchargement de '.$this->url);
                copy($this->url, Storage::path($id));
            }catch(\Exception $e){
                return view('dashboard',['message'=>'Votre tableur n\'est pas lisible, avez-vous <a href="https://support.google.com/a/users/answer/9308873?hl=fr" target="_blank"> partagé publiquement votre document</a> ?']);
            }

        }
        $this->sheet = \PhpOffice\PhpSpreadsheet\IOFactory::load(Storage::path($id))->getSheet(0)->toArray();
        Log::debug($this->sheet);
        if(null==$this->sheet){
            dd(Storage::path($id));
        }
    }




}
