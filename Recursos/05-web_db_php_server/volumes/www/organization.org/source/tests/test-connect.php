<?php

require_once("../domain/connect.php");

echo print_r($databases);

// Debug
if (!count(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS)) and DEBUG) {
    $DBC = new DataBaseConnection();
    echo "<br>\n". '[CONNECTION STATUS]: ' . $DBC->get_state() . " " . $DBC->driver . " " . $DBC->type;
    if ($DBC->error) {
        echo "<br>\n" . '[ERROR]: ' . $DBC->error;
    } else {
        echo "<br>\n" . '[RESOURCE TYPE]: ' . get_resource_type($DBC->resource);
        echo "<br>\n" . '[RESOURCE DUMP]: ';
        echo "<br>\n" . var_dump($DBC->resource);
    }
}