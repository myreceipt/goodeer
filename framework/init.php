<?php
if (!defined("JUICYCODES")) {
    exit;
}
if (DEBUG == true) {
    error_reporting(E_ALL);
    if (SHOW_DEBUG == true) {
        ini_set('display_errors', true);
    } else {
        ini_set('display_errors', false);
    }
} else {
    error_reporting(0);
}
if (file_exists(ABSPATH . "setup")) {
    exit("Please run setup or delete 'setup' folder if setup finished!");
}
ob_start();
require_once __DIR__ . DIRECTORY_SEPARATOR . 'Autoload.php';
use IT\App;
use IT\Data;
use IT\Database;
use IT\Variables;
App::Config(array(
    "name"    => "google_drive_proxy",
    "version" => "1.7.0",
));
App::Initialize();

$db = new Database(DB_HOST, DB_USER, DB_PASS, DB_NAME);
App::SetTimeZone(Data::Get("timezone"));
$var = new Variables;
