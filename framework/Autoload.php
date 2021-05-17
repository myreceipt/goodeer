<?php
function IT_AUTOLOADER($class)
{
    $levels = explode("\\", $class);
    if ($levels["0"] == "IT") {
        unset($levels["0"]);
    }
    $class = implode(DIRECTORY_SEPARATOR, $levels);
    $file  = __DIR__ . DIRECTORY_SEPARATOR . $class . ".php";
    if (is_readable($file)) {
        require $file;
    }
}
spl_autoload_register("IT_AUTOLOADER");
