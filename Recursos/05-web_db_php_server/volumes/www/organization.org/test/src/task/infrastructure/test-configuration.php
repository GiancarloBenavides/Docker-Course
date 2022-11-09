<?php

require_once("../../../../source/task/infrastructure/configuration.php");

use task\infrastructure\configuration as config;

header('Content-Type: application/json');

$cnf = new config\ConfigurationScope("../../../../source/task/infrastructure/config");

$cnf->print();
