<?php
namespace IT;

/**
 * Some necessary tools
 * @package IT\Tools
 * @author JuicyCodes
 * @version 1.0.5
 * @created 01-04-2017 10:43 PM
 * @modified 14-06-2017 05:02 PM
 */
class Tools
{
    private static $headers = array();

    /**
     * Return Human readable video source
     * @param string $source
     */
    public static function Source($source)
    {
        if ($source == "drive") {
            return "Google Drive";
        } elseif ($source == "photo") {
            return "Google Photos";
        } else {
            return "Unknown";
        }
    }

    /**
     * Return human readable status indicator
     * @param int $status
     * @param string $dom
     */
    public static function Status($status, $dom = "label")
    {
        if ($status == "1") {
            $text  = "ACTIVE";
            $class = "success";
        } else {
            $text  = "BLOCKED";
            $class = "danger";
        }

        if ($dom) {
            return "<span class='$dom $dom-$class'>$text</span>";
        } else {
            return $text;
        }
    }

    /**
     * Return human readable role indicator
     * @param int $role
     * @param string $dom
     */
    public static function Role($role, $dom = "badge")
    {
        if ($role == "1") {
            $text  = "Admin";
            $class = "admin";
        } else {
            $text  = "Editor";
            $class = "editor";
        }

        if ($dom) {
            return "<span class='$dom $dom-$class'>$text</span>";
        } else {
            return $text;
        }
    }

    /**
     * Convert an array to object
     * @param array $array
     */
    public static function Object($array)
    {
        $string = json_encode($array);
        $object = json_decode($string);
        return $object;
    }

    /**
     * Return part of a string
     * @param string $text
     * @param int $limit
     */
    public static function Truncate($text, $limit)
    {
        if (strlen($text) > $limit) {
            $end = "...";
        }
        return mb_substr($text, 0, $limit) . $end;
    }

    /**
     * Parses the string into object
     * @param string $str
     */
    public static function Parse($str)
    {
        parse_str($str, $parse);
        return self::Object($parse);
    }

    /**
     * Parse CURL Headers
     * @param boolean $ch
     * @param boolean $header
     */
    public static function Headers($ch = false, $header = false)
    {
        if ($ch === false && $header === false) {
            return Tools::Object(self::$headers);
        } else {
            $details = explode(':', $header);
            if (count($details) == 2) {
                $key   = str_replace("-", "_", strtolower(trim($details[0])));
                $value = trim($details[1]);

                self::$headers[$key] = $value;
            } else {
                if (preg_match('/^HTTP/i', $header)) {
                    self::$headers["http_status"] = trim($header);
                }
            }
            return strlen($header);
        }
    }

    /**
     * Returns the JSON representation of a value
     * @param array $array
     */
    public static function ReturnJSON($array)
    {
        header("Cache-Control: private no-store, no-cache, must-revalidate, max-age=0");
        header("Cache-Control: post-check=0, pre-check=0", false);
        header("Pragma: no-cache");
        header('Content-Type: application/json');
        echo json_encode($array);
    }

    /**
     * Remove special characters from a string
     * @param string $string
     */
    public static function Clean($string)
    {
        $string = str_replace(' ', '_', $string);
        return strtolower(preg_replace('/[^A-Za-z0-9\-]/', '_', $string));
    }

    /**
     * Get host from a URL
     * @param string $url
     */
    public static function GetHost($url)
    {
        return trim(parse_url($url, PHP_URL_HOST)) ?: false;
    }

    /**
     * Add zero to an integer
     * @param  int $num
     * @return int
     */
    public static function Zero($num)
    {
        return sprintf("%02d", $num);
    }
}
