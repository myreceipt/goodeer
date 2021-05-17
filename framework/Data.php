<?php
namespace It;

/**
 * Simple Data fetching class
 * @package IT\Data
 * @author JuicyCodes
 * @version 1.0.5
 * @created 01-04-2017 10:04 PM
 * @modified 10-04-2017 04:10 PM
 */
class Data
{
    private static $settings;

    /**
     * Get Settings From Database
     * @param string $name
     */
    public static function Get($name)
    {
        global $db;
        if (empty(self::$settings)) {
            $settings = $db->select("settings");
            while ($set = $settings->fetch_object()) {
                self::$settings[$set->name] = $set->value;
            }
        }
        return self::$settings[$name] ?: false;
    }

    /**
     * Get Base Path For AaltoRouter
     * @param string  $base
     * @param string $url
     * @return string
     */
    public static function BasePath($base, $url = false, $path = false)
    {
        if (empty($path)) {
            $url   = $url ?: "http://" . $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"];
            $path  = parse_url($url, PHP_URL_PATH);
            $base  = basename($base);
            $paths = explode($base, $path);
            if (empty($paths["1"])) {
                $base = false;
            } else {
                $base = $paths["0"] . $base;
            }
            return $base;
        } else {
            return $path;
        }
    }
}
