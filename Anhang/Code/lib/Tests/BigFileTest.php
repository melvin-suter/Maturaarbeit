<?php

namespace Tests;

use Models\Test;

class BigFileTest extends Test
{
    public $name = "Big Files Test";

    public function test()
    {
        $path = realpath(__DIR__.'/../../public/test.txt');
        file_put_contents($path,"-");

        for($i = 0; $i < 10; $i++)
        {
            $content = file_get_contents($path);
            $content = str_repeat($i,100*1000000);
            file_put_contents($path,$content);
        }
    }

}