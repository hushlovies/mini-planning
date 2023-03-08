<?php
    require_once 'vendor/autoload.php';
    //connection to a distant database
    $manager = new MongoDB\Client('mongodb+srv://hushlovies:popsicle@cluster0.7ltotjh.mongodb.net/test');
    $mongo = new MongoDB\Driver\Manager('mongodb+srv://hushlovies:popsicle@cluster0.7ltotjh.mongodb.net/test');
    $database = $manager->selectDatabase('testPro'); //recup database
    $collection = $database->selectCollection('update'); //recup collection
