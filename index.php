<?php

include 'classes/cars.php';
include 'classes/create.php';

include 'cli/script.php';

$create = new Create();

$create->createDb();

$create->createCarsTable();
        
$create->createBuyersTable();

$create->createForeignKey();

$insert = new Cars();

$insert->insertCars();