<?php

require __DIR__ . '/vendor/autoload.php';

use Doctrine\Common\EventManager;
use Doctrine\DBAL\Configuration;
use Doctrine\DBAL\Driver\PDOMySql\Driver;
use Pharako\DBAL\Connection;

$params = [
    'dbname' => 'web-app',
    'host' => 'db1',
    'user' => 'web-app',
    'password' => 'web-app',
    'driver' => 'pdo_mysql'
];

$dbal = new Connection(
    $params,
    new Driver(),
    new Configuration(),
    new EventManager()
);

$things = $dbal->fetchAll("SELECT `name` FROM `things`");
foreach ($things as $thing) {
    printf("<span>%s<span><br />", $thing['name']);
}
