<?php
//require framework files
require 'Slim/Slim.php';
require 'doctrine/lib/doctrine.php';
spl_autoload_register(array('Doctrine', 'autoload'));
$manager = Doctrine_Manager::getInstance();

//Le database and other goodies
$dsn = 'mysql:dbname=mygame;host=127.0.0.1';
$dbuser = 'root';
$dbpass = '123456';
$dbh = new PDO( $dsn, $dbuser, $dbpass );

$dbcon = Doctrine_Manager::connection($dbh);

$dbcon->setOption('username', $dbuser);
$dbcon->setOption('password', $dbpass);

$manager->setAttribute(Doctrine_Core::ATTR_AUTOLOAD_TABLE_CLASSES, true);

Doctrine_Core::loadModels(dirname(__FILE__).'/models');

//Le web application
$app = new Slim();
$app->dbcon = $dbcon;


//URL paths and such
require 'routes.php';

//Le start 
$app->run();

