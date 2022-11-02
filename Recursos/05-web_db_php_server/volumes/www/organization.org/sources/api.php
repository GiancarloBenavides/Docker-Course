<?php

require_once("./base/connection.php");

$DBC = new DataBaseConnection();

// Debug
if (!count(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS)) and DEBUG) {
    $DBC = new DataBaseConnection();
    echo '[CONNECTION STATUS]: ' . $DBC->get_state();
    echo "<br>\n";
}
