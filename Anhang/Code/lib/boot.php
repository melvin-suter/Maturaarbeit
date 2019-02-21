<?php

/*
 * Loading Config
 */
require(__DIR__.'/config.php');


/*
 * Loading Models
 */
require(__DIR__.'/Models/Timer.php');
require(__DIR__.'/Models/Test.php');
require(__DIR__.'/Models/TestSerie.php');

/*
 * Loading Helper
 */
require(__DIR__.'/Helper/TestHelper.php');
require(__DIR__ . '/Helper/ExportHelper.php');

/*
 * Loading App
 */
require(__DIR__.'/App.php');