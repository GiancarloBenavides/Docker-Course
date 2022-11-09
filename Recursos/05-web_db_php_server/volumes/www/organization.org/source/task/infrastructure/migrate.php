<?php

namespace task\infrastructure\migrate;

/** 
 * TODO-GNX
 * PHP Version 7.4
 * @package Base
 * @author Giancarlo
 * @version 1.0
 * @copyright 2020 GNC
 */

use task\infrastructure\config as cnf;
use task\infrastructure\connect;

include_once(realpath(dirname(__FILE__)) . "/config.php");
echo $cnf->files->bounded;
include_once("./connect.php");



/**
 * Migrate to a database.
 * 
 * The class allows to define the connection with a database
 * * __Methods:__ [up, _down_..].
 * 
 * @since 1.0.0
 */
class DataBaseMigration
{
    public $folder;
    public $file;
    public $type;
    public $data;
    public $error;
    public $status;

    /**
     * DataBaseConnection class constructor.
     */
    public function __construct(object $dbc, object $cnf)
    {
        //$databases = include(realpath(dirname(__FILE__) . "/../config") . "/databases.php");
        $this->folder = $cnf->files->scripts;
        $this->basename = array("up", "down");
        //$this->type = $type;
        //$this->data = $include_data;
        $this->down($dbc->resource, $cnf, "scheme");
    }

    public function up($db, bool $include_data = false)
    {
        if ($this->type == "up") {
            $filename = $this->folder . "/" . $this->basename[0];
            $scheme_sql = $filename . "-scheme.sql";
            $data_sql = $filename . "-data.sql";
            //$this->up();
        } else {
        }
        global $msj;
        $scheme_sql = file_get_contents($this->folder . "/" . $this->file);
        $result = pg_query($db, $scheme_sql);
        if (!$result) {
            echo $msj->query_error . pg_last_error();
        }
        if ($this->data) {
            $data_sql = file_get_contents($this->folder . "/" . $this->file);
            $result = pg_query($db, $data_sql);
            if (!$result) {
                echo $msj->query_error . pg_last_error();
            }
        }
    }

    public function down($db, object $config, string $type = "scheme")
    {
        $today = date("Y-m-d", time());
        $filename = $this->folder . "/" . $today;
        if (($type == "scheme") or ($type == "both")) {
            $scheme_sql = $filename . "-" . pg_dbname($db) . "-scheme.sql";
            $result = pg_query($db, $config->statements->scheme);
            if (!$result) {
                echo $config->msj->query_error . pg_last_error();
                return false;
            }
            $sql_file = fopen($scheme_sql, "w");
            fwrite($sql_file, "--hola mundo");
            fclose($sql_file);
        }
        if (($type == "data") or ($type == "both")) {
            $data_sql = $filename . "-" . pg_dbname($db) . "-data.sql";
            $result = pg_query($db, $config->statements->scheme);
            if (!$result) {
                echo $config->msj->query_error . pg_last_error();
                return false;
            }
            $sql_file = fopen($data_sql, "w");
            fwrite($sql_file, "--hola mundo");
            fclose($sql_file);
        }
    }
}
