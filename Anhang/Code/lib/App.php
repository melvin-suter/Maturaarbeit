<?php

/*
 * Base Class which executes everyting
 */
class App
{
    public static function run()
    {
        // Load Tests
        \Helper\TestHelper::loadTests();
        // Run Test Series
        for($i = 0 ; $i < CONFIG_SERIES ; $i++)
            \Helper\TestHelper::runTestSerie();

        // Printing Results
        $method = isset($_GET['m']) ? $_GET['m'] : '';
        switch($method)
        {
            case 'php':
                echo "<pre>";
                print_r(\Helper\TestHelper::result());
                echo "</pre>";
                break;
                
            default:
            case 'json':
                \Helper\ExportHelper::resultToJSON(\Helper\TestHelper::result());
                break;

            case 'csv':
                \Helper\ExportHelper::resultToCSV(\Helper\TestHelper::result());
                break;

            case 'html':
                \Helper\ExportHelper::resultToHTML(\Helper\TestHelper::result());
                break;
        }

    }
}