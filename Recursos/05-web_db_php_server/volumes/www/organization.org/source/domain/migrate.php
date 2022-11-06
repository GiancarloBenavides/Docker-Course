<?php

require_once("./connect.php");
$msj = include("../config/messages.php");
$scheme_sql = file_get_contents("../scripts/start_scheme.sql");
$data_sql = file_get_contents("../scripts/start_dummy.sql");


$dbc = new DataBaseConnection();

echo "<br>--- BEGIN ---";

$result = pg_query($dbc->resource, $scheme_sql);
if (!$result) {
    echo $msj->query_error . pg_last_error();
} else {
    echo "<br>\n" . '[SCHEME]: ' . "OK";
}

$result = pg_query($dbc->resource, $data_sql);
if (!$result) {
    echo $msj->query_error . pg_last_error();
} else {
    echo "<br>\n" . '[MIGRATION]: ' . "OK";
}



echo "<br>----- END -----";
