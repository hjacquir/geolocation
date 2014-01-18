<?php
use \Hj\Console;
use \Symfony\Component\Console\Application;

require_once './vendor/autoload.php';

$app = new Application();

$app->add(new Console());
$app->run();