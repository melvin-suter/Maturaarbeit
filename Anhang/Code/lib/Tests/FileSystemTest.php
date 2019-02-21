<?php

namespace Tests;

use Models\Test;

class FileSystemTest extends Test
{
    public $name = "File System Test";

    public function test()
    {
        $path = realpath(__DIR__.'/../../public/test.txt');
        file_put_contents($path,"-");

        for($i = 0; $i < 1000; $i++)
        {
            $content = file_get_contents($path);
            $content .= str_repeat($i,$i);
            file_put_contents($path,$content);
        }
    }

}