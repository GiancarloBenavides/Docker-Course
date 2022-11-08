<?php

require_once("../../../../source/task/infrastructure/config.php");

use task\infrastructure\config as cnf;

header('Content-Type: application/json');

$config = new cnf\ConfigurationScope("../../../../source/task/infrastructure/config");

$config->print();
