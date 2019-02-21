<?php

namespace Helper;


class ExportHelper
{
    public static function resultToCSV($results)
    {
        $rowCounter = 0;

        header('Content-Type: text/csv');

        $echo = 'Nr,Time,';
        foreach($results['average'] as $key => $value)
            $echo .= $key.',';
        $echo = substr($echo,0,-1);
        $echo .= "\n";

        $echo .= $rowCounter.',Average,';
        foreach($results['average'] as $key => $value)
            $echo .= Self::microtimeToSec($value,false).',';
        $echo = substr($echo,0,-1);
        $echo .= "\n";
        $rowCounter++;

        foreach($results['series'] as $serie)
        {
            $echo .= $rowCounter.','.Self::microtimeToTime($serie['startTime']).',';
            foreach($serie['results'] as $result)
                $echo .=  Self::microtimeToSec($result['value'],false).',';
            $echo = substr($echo,0,-1);
            $echo .= "\n";
            $rowCounter++;
        }
        echo $echo;
    }

    public static function resultToHTML($results)
    {
        $rowCounter = 0;

        echo '<html>';
        echo '<head>';
        echo '<title>Benchmarck</title>';
        echo '<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">';
        echo '</html>';
        echo '<body>';
        echo '<div class="container">';
        echo '<table class="table">';

        echo '<tr>';
        echo '<th>Nr</th>';
        echo '<th>Time</th>';
        foreach($results['average'] as $key => $value)
          echo '<th>'.$key.'</th>';
        echo '</tr>';

        echo '<tr>';
        echo '<td>'.$rowCounter.'</td>';
        echo '<td>Average</td>';
        foreach($results['average'] as $key => $value)
            echo '<td>'.Self::microtimeToSec($value).'</td>';
        echo '</tr>';
        $rowCounter++;

        foreach($results['series'] as $serie)
        {
            echo '<tr>';
            echo '<td>'.$rowCounter.'</td>';
            echo '<td>'.Self::microtimeToTime($serie['startTime']).'</td>';
            foreach($serie['results'] as $result)
                echo '<td>'.Self::microtimeToSec($result['value']).'</td>';
            echo '</tr>';
            $rowCounter++;
        }

        echo '</table>';
        echo '</div>';
        echo '</body>';
    }

    public static function microtimeToTime($microtime)
    {
        $microseconds = sprintf("%03d",($microtime - floor($microtime)) * 1000000);
        return date('H:i:s.'.$microseconds,$microtime);
    }

    public static function microtimeToSec($microtime,$asString = true)
    {
        return round($microtime * 1000,3) . ($asString ? " ms" : '');
    }

    public static function resultToJSON($results)
    {
        $print = ['Average' => $results['average']];

        foreach($results['series'] as $serie)
        {
            $serieData = [];
            foreach($serie['results'] as $test)
                $serieData[$test['name']] = $test['value'];

            $print[$serie['startTime']] = $serieData;
        }

        echo json_encode($print);
    }
}