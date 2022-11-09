<?php

require_once("../../../../source/task/infrastructure/configuration.php");
require_once("../../../../source/task/infrastructure/connect.php");

use task\infrastructure\configuration;
use task\infrastructure\connect;

$config = new configuration\ConfigurationScope("../../../../source/task/infrastructure/config");
$cnf = (object) $config->scope;
$DBC = new connect\DataBaseConnection($cnf);


echo "<br>\n" . '[CONNECTION STATUS]: ' . $DBC->get_state() . " " . $DBC->driver . " - " . $DBC->type;
if ($DBC->error) {
    echo "<br>\n" . '[ERROR]: ' . $DBC->error;
} else {
    echo "<br>\n" . '[RESOURCE TYPE]: ' . get_resource_type($DBC->resource);
    echo "<br>\n" . '[RESOURCE DUMP]: ';
    echo "<br>\n" . var_dump($DBC->resource);
}
