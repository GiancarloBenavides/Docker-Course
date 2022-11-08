<?php

/** 
 * TODO-GNX
 * PHP Version 7.4
 * @package config domain
 * @author Giancarlo
 * @version 1.0
 * @copyright 2020 GNC
 */


// Server database
$paths = array(
    'host' => 'postgres',
    'user' => 'gncdev',
    'pass' => 'postgres',
    'name' => 'todo_db',
    'driver' => 'pgsql',
    'port' => '5432',
    'debug' => false
);

// Return fil type [production | development]
return (object) $paths;
