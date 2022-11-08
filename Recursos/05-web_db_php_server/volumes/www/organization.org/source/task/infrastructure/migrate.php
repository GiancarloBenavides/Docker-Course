<?php

namespace task\infrastructure\migration;

/** 
 * TODO-GNX
 * PHP Version 7.4
 * @package Base
 * @author Giancarlo
 * @version 1.0
 * @copyright 2020 GNC
 */

use task\domain\connect;
use task\domain\config;
$msj = include(realpath(dirname(__FILE__) . "/../config") . "/messages.php");

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
    public function __construct(string $basename, string $dirname, string $type = "down", bool $include_data = false)
    {
        $databases = include(realpath(dirname(__FILE__) . "/../config") . "/databases.php");
        $this->folder = $dirname;
        $this->file = $basename;
        $this->type = $type;
        $this->data = $include_data;
        if ($this->type == "up") {
            $this->up();
        } else {
            $this->up();
        }
    }

    public function up()
    {
        global $msj;
        $scheme_sql = file_get_contents($this->folder . "/" . $this->file);
        $dbc = new connect\DataBaseConnection();
        $result = pg_query($dbc->resource, $scheme_sql);
        if (!$result) {
            echo $msj->query_error . pg_last_error();
        }
        if ($this->data) {
            $data_sql = file_get_contents($this->folder . "/" . $this->file);
            $result = pg_query($dbc->resource, $data_sql);
            if (!$result) {
                echo $msj->query_error . pg_last_error();
            }
        }
    }

    public function down()
    {
    }
}