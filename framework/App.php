<?php
namespace IT;

/**
 * Set some default settings for current application
 * @package IT\App
 * @author JuicyCodes
 * @version 1.1.1
 * @created 01-04-2017 09:42 PM
 * @modified 06-06-2017 04:15 AM
 */
class App
{
    private static $error_reporting = E_ALL & ~E_NOTICE & ~E_WARNING;
    private static $display_errors  = true;
    private static $time_zone       = "UTC";
    private static $charset         = "utf8";
    private static $version;
    private static $name;

    /**
     * Set application startup settings
     */
    public static function Initialize()
    {
        self::StartSession();
        self::SetTimeZone();
    }

    /**
     * Set confgiuration values
     * @param array $vars
     */
    public static function Config(array $vars)
    {
        foreach ($vars as $key => $value) {
            self::${$key} = $value;
        }
    }

    /**
     * Get Application Name
     */
    public static function Name()
    {
        return self::Get("name");
    }

    /**
     * Get Application Version
     */
    public static function Version()
    {
        return self::Get("version");
    }

    /**
     * Sets which PHP errors are reported
     * @param boolean $level
     */
    public static function ErrorReporting($level = false)
    {
        if ($level) {
            self::$error_reporting = $level;
        }
        error_reporting(self::$error_reporting);
    }

    /**
     * Enable `display_errors`
     */
    public static function ShowErrors()
    {
        self::$display_errors = true;
        ini_set("display_errors", self::$display_errors);
    }

    /**
     * Disable `display_errors`
     */
    public static function HideErrors()
    {
        self::$display_errors = false;
        ini_set("display_errors", self::$display_errors);
    }

    /**
     * Sets the default timezone
     * @param string $zone
     */
    public static function SetTimeZone($zone = false)
    {
        if ($zone) {
            self::$time_zone = $zone;
        }
        date_default_timezone_set(self::$time_zone);
    }

    /**
     * Start new or resume existing session
     * @param array $options
     */
    public static function StartSession($options = false)
    {
        if (is_array($options)) {
            self::$session_options = $options;
            session_start(self::$session_options);
        } else {
            session_start();
        }
    }

    /**
     * Gets the value of a configuration option
     * @param string $var
     */
    public static function Get($var)
    {
        if (self::${$var}) {
            return self::${$var};
        } else {
            return false;
        }
    }
}
