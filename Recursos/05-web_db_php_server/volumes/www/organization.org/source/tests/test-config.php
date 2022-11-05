<?php

require_once("../domain/config.php");
header('Content-Type: application/json');

$config = new ConfigurationScope;

$config->print();
