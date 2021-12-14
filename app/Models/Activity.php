<?php


namespace App\Models;


class Activity
{
    public $ref;
    public $description;
    public $duration;
    public $start;
    public $end;
    public $data;

    /**
     * Activity constructor.
     * @param $ref
     * @param $description
     * @param $duration
     * @param $start
     * @param $end
     * @param $data
     */
    public function __construct($ref, $description, $duration, $start, $data)
    {
        $this->ref = $ref;
        $this->description = $description;
        $this->duration = floatval($duration);
        $this->start=$start;
        $this->end = $this->start+$this->duration;
        $this->data = $data;
    }


}
