<?php
include_once('./app/Mage.php');
include_once('./app/code/local/autoload.php');

error_reporting(E_ALL);
define("DS", DIRECTORY_SEPARATOR);
date_default_timezone_set('Asia/Kolkata');

Mage::init();

?>