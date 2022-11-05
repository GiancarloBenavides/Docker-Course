<?php

/**
 * Configuration
 * @global string HOST database host
 * @global string USER database user
 * @global string PASS database password
 * @global string DB database name
 */



// Server database
define("DB_HOST", "postgres");
define("DB_USER", "gncdev");
define("DB_PASS", "postgres");
define("DRIVER", "pgsql");
define("DEBUG", True);

 // Postgres database
define("DB_PGSQL_PORT","5432");
define("DB_WORK","todo_db");


 // MySQL database
 define("DB_MYSQL_PORT","3306");
 define("DB_ALT","todo_db");


// String Connection
$pgsql_string = "host=" . DB_HOST . " port=" . DB_PGSQL_PORT . " user=" . DB_USER . " password=" . DB_PASS . " dbname="  .  DB_WORK;
$pdo_pgsql_string = 'pgsql:dbname=' . DB_WORK . '; host=' . DB_HOST . '; port=' . DB_PGSQL_PORT;
$pdo_mysql_string = 'mysql:dbname=' . DB_ALT . '; host=' . DB_HOST . '; port=' . DB_MYSQL_PORT;


// Debug
if (!count(debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS)) and DEBUG) {
    echo '[PGSQL]: ' . $pgsql_string; echo "<br>\n";
    echo '[PDO_PGSQL]: ' . $pdo_pgsql_string; echo "<br>\n";
    echo '[PDO_MYSQL]: ' . $pdo_mysql_string; echo "<br>\n";
}



