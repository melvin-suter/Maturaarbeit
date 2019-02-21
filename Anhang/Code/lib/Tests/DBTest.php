<?php

namespace Tests;

use Models\Test;

class DBTest extends Test
{
    public $name = "DB Test";

    public function test()
    {
        $pdo = new \PDO('mysql:host=localhost', 'root', '');
        $pdo->query("CREATE DATABASE benchmark_test;");
    
        $pdo = new \PDO('mysql:host=localhost;dbname=benchmark_test', 'root', '');
        $pdo->exec("CREATE TABLE data_test(id INT(10) AUTO_INCREMENT PRIMARY KEY, key_col VARCHAR(255), value_col VARCHAR(255) );");
        for($i = 0; $i < 1000; $i++)
            $pdo->exec("INSERT INTO data_test(key_col,value_col) VALUES('$i','$i');");

        foreach($pdo->query("SELECT * FROM data_test;") as $row)
        {
            $q = $pdo->query("SELECT * FROM data_test WHERE id = ".$row['id']);
            $id = !$q ? -1 : $q->fetch()['id'];
            $pdo->exec("DELETE FROM data_test WHERE id = $id");
        }

        $pdo = new \PDO('mysql:host=localhost', 'root', '');
        $pdo->exec("DROP DATABASE benchmark_test;");
        $pdo = null;
    }

}