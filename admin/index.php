<?php
require_once 'init.php';
use IT\Data;
use IT\Plugins\AltoRouter;

ob_start("html_minification");
$router = new AltoRouter();
$router->setBasePath(Data::BasePath(ADMINPATH));

$router->addRoutes(array(
    array('GET', '/', __DIR__ . '/pages/dashboard.php', 'dashboard'),
    array('GET|POST', '/login/', __DIR__ . '/pages/login.php', 'login'),
    array('GET|POST', '/actions/', __DIR__ . '/actions.php', 'actions'),
    array('POST', '/ajax/license_details/', __DIR__ . '/actions.php', 'license_details'),
));

/** Routers For Various "Add" Pages */
$router->addRoutes(array(
    array('GET|POST', '/add/user/', __DIR__ . '/pages/add_user.php', 'add_user'),
    array('GET', '/add/link/', __DIR__ . '/pages/add_link.php', 'add_link'),
    array('GET', '/add/links/', __DIR__ . '/pages/add_links.php', 'add_links'),
));

/** Routers For Various "Manage" Page */
$router->addRoutes(array(
    array('GET', '/manage/links/', __DIR__ . '/pages/manage_links.php', 'manage_links'),
    array('GET', '/manage/users/', __DIR__ . '/pages/manage_users.php', 'manage_users'),
));

/** Routers For Various "Log" Page */
$router->addRoutes(array(
    array('GET', '/log/clear/', __DIR__ . '/actions.php', 'clear_log'),
    array('GET', '/log/enable/', __DIR__ . '/actions.php', 'enable_log'),
    array('GET', '/log/disable/', __DIR__ . '/actions.php', 'disable_log'),
    array('GET', '/log/list/', __DIR__ . '/pages/list_log.php', 'list_log'),
    array('GET', '/log/user/[i:id]/', __DIR__ . '/pages/manage_log.php', 'user_logs'),
));

/** Routers For Various "Cache" Page */
$router->addRoutes(array(
    array('GET', '/cache/clear/all/', __DIR__ . '/actions.php', 'clear_all_cache'),
    array('GET', '/cache/clear/expired/', __DIR__ . '/actions.php', 'clear_expired_cache'),
));

/** Routers For Various "Link" Page */
$router->addRoutes(array(
    array('GET', '/link/visit/[i:id]/', __DIR__ . '/actions.php', 'visit_link'),
    array('GET', '/link/delete/[i:id]/', __DIR__ . '/actions.php', 'delete_link'),
    array('GET', '/link/edit/[i:id]/', __DIR__ . '/pages/edit_link.php', 'edit_link'),
    array('GET', '/links/user/[i:id]/', __DIR__ . '/pages/manage_links.php', 'user_links'),
));

/** Routers For Various "Settings" Page */
$router->addRoutes(array(
    array('GET', '/settings/general/', __DIR__ . '/pages/settings/general.php', 'general_settings'),
    array('GET', '/settings/misc/', __DIR__ . '/pages/settings/misc.php', 'misc_settings'),
    array('GET', '/settings/player/', __DIR__ . '/pages/settings/player.php', 'player_settings'),
    array('GET', '/settings/firewall/', __DIR__ . '/pages/settings/firewall.php', 'firewall_settings'),
    array('GET', '/settings/optimizer/', __DIR__ . '/pages/settings/optimizer.php', 'optimizer_settings'),
    array('GET', '/settings/advertise/', __DIR__ . '/pages/settings/advertise.php', 'advertise_settings'),
));

/** Routers For "User" Pages */
$router->addRoutes(array(
    array('GET', '/user/settings/', __DIR__ . '/pages/user_settings.php', 'user_settings'),
    array('GET', '/user/logout/', __DIR__ . '/pages/logout.php', 'user_logout'),
    array('GET', '/user/ban/[i:id]/', __DIR__ . '/actions.php', 'ban_user'),
    array('GET', '/user/unban/[i:id]/', __DIR__ . '/actions.php', 'unban_user'),
    array('GET', '/user/delete/[i:id]/', __DIR__ . '/actions.php', 'delete_user'),
    array('GET', '/user/edit/[i:id]/', __DIR__ . '/pages/edit_user.php', 'edit_user'),
));

$match = $router->match();
if ($match) {
    if (is_readable($match["target"])) {
        $var->parse_get($match["params"]);
        if (empty($var->get->action)) {
            $var->parse_get(array("action" => $match["name"]));
        }
        require_once $match["target"];
    } else {
        require_once '404.php';
    }
} else {
    require_once '404.php';
}

/**
 * Minify Given HTML String
 * @param  string $buffer
 * @return string
 */
function html_minification($buffer)
{
    $search  = array('/\>[^\S ]+/s', '/[^\S ]+\</s', '/(\s)+/s');
    $replace = array('>', '<', '\\1');
    $buffer  = preg_replace($search, $replace, $buffer);
    return $buffer;
}
