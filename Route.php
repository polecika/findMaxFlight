<?php


class Route
{
    private $from;
    private $to;
    private $depart;
    private $arrival;
    private $flightTime;

    /**
     * Route constructor.
     * @param $from
     * @param $to
     * @param $depart
     * @param $arrival
     */
    public function __construct($from, $to, $depart, $arrival)
    {
        $this->from = $from;
        $this->to = $to;
        $this->depart = $depart;
        $this->arrival = $arrival;
        $this->flightTime = strtotime($arrival) - strtotime($depart);
    }

    /**
     * @return mixed
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * @return false|int
     */
    public function getFlightTime()
    {
        return $this->flightTime;
    }

    /**
     * @return mixed
     */
    public function getFrom()
    {
        return $this->from;
    }

    /**
     * @return mixed
     */
    public function getDepart()
    {
        return $this->depart;
    }

    /**
     * @return mixed
     */
    public function getArrival()
    {
        return $this->arrival;
    }



}