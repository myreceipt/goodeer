<?php
require_once 'config.php';
use IT\Data;
use IT\Plugins\AltoRouter;

$router = new AltoRouter();
$router->setBasePath(Data::BasePath(ABSPATH));
$router->addRoutes(array(
    array('GET', '/link/[:slug]/[i:quality]/[a:uid]/', ABSPATH . '/link.php', 'file_link'),
    array('GET', '/' . Data::Get("embed_slug") . '/[:slug]/', ABSPATH . '/play.php', 'embed_player'),
    array('GET', '/' . Data::Get("download_slug") . '/[:slug]/', ABSPATH . '/play.php', 'video_download'),
));

$match = $router->match();
if ($match) {
    if (is_readable($match["target"])) {
        $var->parse_get($match["params"]);
        $var->parse_get(array("param" => $match["name"]));
        require_once $match["target"];
    } else {
        require_once TEMPLATES . 'pages/404_error.php';
    }
} else {
    require_once TEMPLATES . 'pages/404_error.php';
}
