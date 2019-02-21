<?php

namespace Tests;

use Models\Test;

class MathTest extends Test
{
    public $name = "Math Test";
    private $functions = [
        'abs' => 1,
        'acos' => 1,
        'acosh' => 1,
        'asin' => 1,
        'asinh' => 1,
        'atan' => 1,
        'atan2' => 2,
        'atanh' => 1,
        'bindec' => 1,
        'ceil' => 1,
        'cos' => 1,
        'cosh' => 1,
        'decbin' => 1,
        'dechex' => 1,
        'decoct' => 1,
        'deg2rad' => 1,
        'exp' => 1,
        'expm1' => 1,
        'floor' => 1,
        'fmod' => 2,
        'getrandmax' => 0,
        'hexdec' => 1,
        'hypot' => 2,
        'is_finite' => 1,
        'is_infinite' => 1,
        'is_nan' => 1,
        'lcg_value' => 1,
        'log' => 1,
        'log10' => 1,
        'log1p' => 1,
        'max' => 2,
        'min' => 2,
        'mt_getrandmax' => 0,
        'mt_rand' => 2,
        'octdec' => 1,
        'pi' => 1,
        'pow' => 2,
        'rad2deg' => 1,
        'rand' => 2,
        'round' => 1,
        'sin' => 1,
        'sinh' => 1,
        'sqrt' => 1,
        'srand' => 1,
        'tan' => 1,
        'tanh' => 1,
    ];

    public function test()
    {
        for($i = 0; $i < 1000; $i++)
            foreach($this->functions as $func => $numParam)
            {
                $params = $numParam > 0 ? explode(',',substr(str_repeat("1,",$numParam),0,-1)) : [];
                
                call_user_func_array($func,$params);
            }
    }

}