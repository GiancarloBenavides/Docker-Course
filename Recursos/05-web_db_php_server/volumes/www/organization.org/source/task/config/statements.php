<?php

/** 
 * TODO-GNX
 * PHP Version 7.4
 * @package config domain
 * @author Giancarlo
 * @version 1.0
 * @copyright 2020 GNC
 */

// QUERY TYPE:
// * C: Create one ----> with HTTP PUT method
// * R: Read all ------> with HTTP GET method
// * U: Update one ----> with HTTP PATCH method
// * D: Delete one ----> with HTTP DELETE method
// * S: Substitute one -> with HTTP PUT method
// * O: Read only one -> with HTTP GET method


return (object) array(
    "create" => "INSERT INTO table_name ($1) VALUES ($2)",
    "read" => 'SELECT * FROM table_name ORDER BY id ASC LIMIT $1',
    "update" => 'UPDATE table_name SET description = $1 WHERE id = $2',
    "delete" => 'DELETE FROM table_name WHERE id = $1',
    "substitute" => 'UPDATE table_name SET description = $1 WHERE id = $2',
    "read_o" => 'SELECT * FROM table_name ORDER WHERE id = $1',
);
