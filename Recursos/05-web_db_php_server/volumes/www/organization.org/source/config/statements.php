<?php

// QUERY TYPE:
// * C: Create one ----> with HTTP PUT method
// * R: Read all ------> with HTTP GET method
// * U: Update one ----> with HTTP PATCH method
// * D: Delete one ----> with HTTP DELETE method
// * S: Subtitute one -> with HTTP PUT method
// * O: Read only one -> with HTTP GET method

class Row
{

    public $c;
    public $r;
    public $u;
    public $d;
    public $s;
    public $o;

    public function __construct()
    {
        $this->c = 'INSERT INTO table_name ($1) VALUES ($2)';
        $this->r = 'SELECT * FROM table_name ORDER BY id ASC LIMIT $1';
        $this->u = 'UPDATE table_name SET description = $1 WHERE id = $2';
        $this->d = 'DELETE FROM table_name WHERE id = $1';
        $this->s = 'UPDATE table_name SET description = $1 WHERE id = $2';
        $this->o = 'SELECT * FROM table_name ORDER WHERE id = $1';
    }

    public function create($name_columns, $values)
    {
    }
    public function read($num)
    {
    }
    public function update($name_columns, $values, $id)
    {
    }
    public function delete($id)
    {
    }
    public function sustitute($name_columns, $values, $id)
    {
    }
    public function read_one($id)
    {
    }
}
