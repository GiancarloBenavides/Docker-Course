<?php

/** 
 * TODO-GNX
 * PHP Version 7.4
 * @package config domain
 * @author Giancarlo
 * @version 1.0
 * @copyright 2020 GNC
 */

$config_context = dirname(__FILE__);
$bounded_context = realpath($config_context . "/../../");
$sql_context = realpath($config_context . "/../scripts");

// location of execution contexts
$files = array(
    'config' => $config_context,
    'bounded' => $bounded_context,
    'scripts' => $sql_context
);

// Return location of files
return (object) $files;
