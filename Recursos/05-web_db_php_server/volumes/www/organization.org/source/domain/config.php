<?php

/** 
 * TODO-GNX
 * PHP Version 7.4
 * @package Base
 * @author Giancarlo
 * @version 1.0
 * @copyright 2020 GNC
 */


/**
 * Include configuration files.
 * 
 * The class allows to import all configuration options.
 * * __Methods:__ [load, _close_..].
 * 
 * @since 1.0.0
 */
class ConfigurationScope
{
    public $folder;
    public $file_extension;
    public $wipe;
    public $scope;


    /**
     * DataBaseConnection class constructor.
     */
    public function __construct()
    {
        $this->folder = "../config";
        $this->file_extension = "php";
        $this->wipe = array("databases");
        $this->scope = array();
        $this->load();
    }

    /**
     * load config
     * @return boolean
     */
    function load()
    {
        $search_pattern = $this->folder . "/*" . $this->file_extension;
        $paths = glob($search_pattern);
        if ($index = array_search($this->folder . "/databases.php", $paths)){
            unset($paths[$index]);
        }
        foreach ($paths as $path) {
            $file = explode(".", basename($path))[0];
            $this->scope = array_merge($this->scope, array($file => include($path)));
        }
    }

    /**
     * Connect to a database
     * @return boolean
     */
    function get()
    {
        return json_encode($this->scope, JSON_PRETTY_PRINT);
    }

    /**
     * Connect to a database
     * @return boolean
     */
    function print()
    {
        $json_config = $this->get();
        return print_r($json_config);
    }
}
