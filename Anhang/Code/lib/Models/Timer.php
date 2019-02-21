<?php

namespace Models;

class Timer
{
    private $startTime = -1;
    private $endTime = -1;

    /*
     * Starts the timer/Set's startTime
     */
    public function start()
    {
        $this->startTime = microtime(true);
    }

    /*
     * Stops the timer/Set's endTime
     */
    public function stop()
    {
        $this->endTime = microtime(true);
    }

    /*
     * Calculates and returns the stopped Time
     *
     * @param integer $decimals if set rounds result with those decimals; if not set returns unrounded result
     * @return float Stopped Time
    */
    public function result($decimals = false)
    {
        return $decimals == false ? $this->endTime - $this->startTime : round($this->endTime - $this->startTime,$decimals);
    }
}