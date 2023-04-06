<?php

use App\RMVC\App;

session_start();
require "../vendor/autoload.php";
require "../routes/web.php";
//phpinfo();
//var_dump(php_ini_loaded_file(), php_ini_scanned_files());
App::run();