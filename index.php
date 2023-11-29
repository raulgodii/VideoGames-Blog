<?php

session_start();

require_once "AutoLoad.php";
require_once "Config/Config.php";

use Controllers\FrontController;
FrontController::main();