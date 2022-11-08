<?php

require_once("../../../../source/task/domain/connect.php");

// echo "<br>";
// echo $_SERVER['SCRIPT_FILENAME'];


// echo "<br>";
// $_SERVER['SCRIPT_FILENAME'] = __FILE__;
// echo "<br>";
// echo "rp:" . realpath("../../../");
// echo "<br>";
// echo $_SERVER['SCRIPT_FILENAME'];

// print_r($msj->db_error);

use task\domain\connect;

$DBC = new connect\DataBaseConnection();


echo "<br>\n". '[CONNECTION STATUS]: ' . $DBC->get_state() . " " . $DBC->driver . " - " . $DBC->type;
if ($DBC->error) {
    echo "<br>\n" . '[ERROR]: ' . $DBC->error;
} else {
    echo "<br>\n" . '[RESOURCE TYPE]: ' . get_resource_type($DBC->resource);
    echo "<br>\n" . '[RESOURCE DUMP]: ';
    echo "<br>\n" . var_dump($DBC->resource);
}
