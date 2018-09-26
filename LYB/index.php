<?php
if (file_exists('application/common.php')) {
	include 'application/common.php';
}
spl_autoload_register();
use framework\runtime;
$method = new runtime;
$method ->start();