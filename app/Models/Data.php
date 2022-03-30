<?php

namespace App\Models;

use Illuminate\Http\Request;
use Illuminate\Support\Collection;


class Data {

    public $url;
    public $rowTitle;
    public $columnDescription;
    public $columnDuration;
    public $graphs;

    public function __construct($items)
    {
        if(is_string($items)){
            $items = json_decode(base64_decode($items));
        }
        if(is_object($items)){
            $items = get_object_vars($items);
        }
        $this->graphs=[new \stdClass()];
        foreach ($items as $key=>$value){
            $this->$key=$value;
        }
    }

    public function merge($data)
    {
        foreach ($data as $key=>$value){
            $this->$key=$value;
        }
        return $this;
    }

    public function toSlug()
    {
        return base64_encode($this);
    }

    public function getLink()
    {
        return base64_encode(json_encode($this));
    }

    public function reorder()
    {
        $this->graphs = collect($this->graphs)->sortBy('order')->values()->each(function($item,$i){
            $item->order=$i+1;
        });
    }
}
