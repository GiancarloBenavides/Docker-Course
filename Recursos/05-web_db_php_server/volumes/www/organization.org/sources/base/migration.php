<?php

require_once("./connection.php");
require_once("../conf.d/messages.php");
$scheme_sql = file_get_contents("../conf.d/make_db.sql");
$data_sql = file_get_contents("../conf.d/dummy.sql");


$dbc = new DataBaseConnection();

echo "<br>--- BEGIN ---";

$result = pg_query($dbc->resource, $scheme_sql);
if (!$result) {
    echo QUERY_ERROR . pg_last_error();
} else {
    echo "<br>\n" . '[SCHEME]: ' . "OK";
}

$result = pg_query($dbc->resource, $data_sql);
if (!$result) {
    echo QUERY_ERROR . pg_last_error();
} else {
    echo "<br>\n" . '[MIGRATION]: ' . "OK";
}



echo "<br>----- END -----";

?>