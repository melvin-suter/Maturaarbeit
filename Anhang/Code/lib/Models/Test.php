<?php

namespace Models;

class Test
{
    private $state = false;
    public $timer;
    public $name = "";

    /*
     * Creates Timer
     */
    public function __construct()
    {
        $this->timer = new Timer();
    }

    /*
     * Needs to be overwritten by Tests, with test-function
     */
    public function test() {}

    /*
     * Runs the test and stops time
     *
     * @throws Exception if test has been executed before
     */
    public function runTest()
    {
        if($this->state)
        {
            throw new Exception("Test already executed!");
        }
        else
        {
            $this->timer->start();
            $this->test();
            $this->timer->stop();
            $this->state = true;
        }
    }

}