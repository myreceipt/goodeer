<?php
require_once '../config.php';
use IT\Data;
use IT\Error;
use IT\Html;
use IT\Paginator;
use IT\User;

$html      = new Html;
$user      = new User;
$error     = new Error;
$paginator = new Paginator;

if (!defined('ADMINPATH')) {
    define('ADMINPATH', dirname(__FILE__));
}
$var->url = Data::Get("url") . '/' . basename(ADMINPATH);
$paginator->limit(Data::Get("page_limit"));

$html->AddStylesheet(array(
    "/assets/css/bootstrap.min.css",
    "/assets/css/plugins/icon-sets.css",
    "/assets/css/plugins/waves.min.css",
    "/assets/css/plugins/sweetalert.min.css",
    "/assets/css/main.min.css",
    "/assets/css/app.css",
    "https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700",
));
$html->AddJavaScript(array(
    "/assets/js/jquery.min.js",
    "/assets/js/bootstrap.min.js",
    "/assets/js/plugins/slimscroll/slimscroll.min.js",
    "/assets/js/plugins/waves/waves.min.js",
    "/assets/js/plugins/toastr/toastr.min.js",
    "/assets/js/plugins/sweetalert.min.js",
    "/assets/js/theme.min.js",
    "/assets/js/app.js",
));
