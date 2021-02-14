<?php
session_start();
ob_start();

#Class Loader
function loadClasses($className) {
    require __DIR__ . '/classes/' . strtolower($className) . '.php';
}

spl_autoload_register('loadClasses');

#Helper Loader
foreach (glob(__DIR__ . '/helper/*.php') as $helperFile) {
    require $helperFile;
}

#DB Connection
$config = require __DIR__ . '/config.php';

try{
    $db = new PDO('mysql:host=' . $config['db']['host'] .
                     ';dbname=' . $config['db']['name'],
                                  $config['db']['user'],
                                  $config['db']['pass']);
}catch(PDOException $e){
    die($e->getMessage());
}