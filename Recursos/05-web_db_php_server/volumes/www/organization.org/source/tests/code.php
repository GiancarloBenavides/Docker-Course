<?php

$databases = (object) array(
    // Production
    'host' => 'postgres',
    'user' => 'gncdev',
    'pass' => 'postgres',
    'name' => 'todo_db',
    'driver' => 'pgsql',
    'port' => '5432',
    // Development
    'dev' => (object) array(
        'host' => 'postgres',
        'username' => 'gncdev',
        'pass' => 'postgres',
        'name' => 'todo_db',
        'driver' => 'pgsql',
        'port' => '5432',
    )
);

$host = "host=" . $databases->host;
$port = "port=" . $databases->port;
$user = "user=" . $databases->user;
$pass = "password=" . $databases->pass;
$name = "dbname=" . $databases->name;
$connection_string = implode(" ", array($host, $port, $user, $pass, $name));

echo print_r($connection_string);
