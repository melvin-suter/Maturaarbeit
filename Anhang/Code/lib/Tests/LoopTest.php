<?php

namespace Tests;

use Models\Test;

class LoopTest extends Test
{
    public $name = "Loop Test";

    public function test()
    {
        $arr = [];
        for($i = 0; $i < 10000; $i++)
            array_push($arr,$i);

        foreach($arr as $el)
            unset($arr[array_search($el,$arr)]);
    }

}