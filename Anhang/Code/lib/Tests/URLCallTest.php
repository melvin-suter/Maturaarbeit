<?php

namespace Tests;

use Models\Test;

class URLCallTest extends Test
{
    public $name = "URL Call test";

    public function test()
    {
        $currenturl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]/";
        
        for($i = 0; $i < 1000; $i++)
            file_get_contents("$currenturl/test.txt?i=$i");
    }

}