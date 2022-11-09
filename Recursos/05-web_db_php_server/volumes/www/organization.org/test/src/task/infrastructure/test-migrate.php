<?php

require_once("../../../../source/task/infrastructure/configuration.php");
require_once("../../../../source/task/infrastructure/connect.php");
require_once("../../../../source/task/infrastructure/migrate.php");

use task\infrastructure\configuration;
use task\infrastructure\connect;
use task\infrastructure\migrate;

$config = new configuration\ConfigurationScope("../../../../source/task/infrastructure/config");
$cnf = (object) $config->scope;
$bd = new connect\DataBaseConnection($cnf);

echo "<br>--- BEGIN ---";
$sql = new migrate\DataBaseMigration($bd, $cnf);
//$sql
echo "<br>----- END -----";


// $result = pg_query($dbc->resource, $scheme_sql);
// if (!$result) {
//     echo $msj->query_error . pg_last_error();
// } else {
//     echo "<br>\n" . '[SCHEME]: ' . "OK";
// }

// $result = pg_query($dbc->resource, $data_sql);
// if (!$result) {
//     echo $msj->query_error . pg_last_error();
// } else {
//     echo "<br>\n" . '[MIGRATION]: ' . "OK";
// }
