<?php
/**
 * Created by PhpStorm.
 * User: melvinsuter
 * Date: 24.09.18
 * Time: 14:17
 */

namespace Models;

use Helper\TestHelper;

class TestSerie
{
    private $tests = [];

    /*
     * Creates objects from tests-array in TestHelper
     */
    public function __construct()
    {
        for($i = 0; $i < count(TestHelper::$tests); $i++)
        {
            $testObject = new TestHelper::$tests[$i];
            array_push($this->tests,$testObject);
        }
    }

    /*
     * Cycles through tests and executes test
     */
    public function runTests()
    {
        for($i = 0; $i < count($this->tests); $i++)
        {
            $this->tests[$i]->runTest();
        }
    }

    /*
     * Returns all Test Results with a grand-total as a php array
     *
     * @return array Test results + grand-total
     */
    public function result()
    {
        $results=[];
        $results[0] = ['name' => 'Total','value' => 0];

        for($i = 0; $i < count($this->tests); $i++)
        {
            $name = $this->tests[$i]->name;
            $result = $this->tests[$i]->timer->result(CONFIG_ROUND_RESULTS);
            array_push($results,['name' => $name, 'value' => $result]);
            $results[0]['value'] += $result;
        }

        return $results;
    }

}