<?php

require_once("../../../../source/task/domain/config.php");

use task\domain\config as cnf;

header('Content-Type: application/json');

$config = new cnf\ConfigurationScope("../../../../source/task/config");

$config->print();


echo (1+1 == 2);