<?php

require_once("../config/querys.php");

$attributes = array("name", "description");
$values = array("Urgente", "Lo mas urgente");

// templates
$c = 'INSERT INTO table_name ($1) VALUES ($2)';
$target = array("table_name", "$1", "$2");
$replace = array("public.dbt_categories", implode(", ", $attributes), "'". implode("', '", $values). "'");

echo str_replace($target, $replace, $c);


