<?php
namespace IT;

use IT\Cache;
use IT\Data;
use IT\Plugins\JSPacker;
use IT\Tools;

/**
 * JuicyCodes Tools
 * @package IT\JuicyCodes
 * @version 1.0.5
 * @created 25-02-2017 10:11 PM
 * @modified 15-06-2017 01:30 AM
 */
class JuicyCodes
{
    private static $strings = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqratuvwxyz0123456789";
    private static $error   = false;
    public static $quality  = 0;

    /**
     * Generate Unique slug
     */
    public static function Slug($slug = false)
    {
        if (empty($slug)) {
            return self::Random();
        } else {
            if (self::Exist($slug)) {
                return false;
            } else {
                return $slug;
            }
        }
    }

    /**
     * Generate Random String
     */
    public static function Random()
    {
        $strings = str_split(self::$strings);
        $slug    = null;
        foreach (range(1, 15) as $i) {
            $slug .= $strings[array_rand($strings)];
        }
        if (self::Exist($slug)) {
            self::Random();
        } else {
            return $slug;
        }
    }

    /**
     * Check if slug already exists
     * @param string $slug
     */
    private static function Exist($slug)
    {
        global $db;
        $slugs = $db->query("SELECT id FROM files WHERE slug='$slug'");
        if ($slugs->num_rows == "0") {
            return false;
        }
        return true;
    }

    /**
     * Encrypt JS
     * @param string $script
     */
    public static function Encrypt($script)
    {
        if (Data::Get("encrypt_js") == "enable") {
            $rand   = rand(20, 100);
            $packer = new JSPacker($script);
            $script = $packer->pack();
            $encode = implode('"+"', str_split(base64_encode($script), $rand));
            return 'JuicyCodes.Run("' . $encode . '");';
        } else {
            return $script;
        }
    }

    /**
     * Check If Subtitle String Is Valid
     * @param  string  $string
     * @return boolean
     */
    public static function isSubtitle($string)
    {
        if (empty($string) || $string == "NO") {
            return false;
        } elseif (preg_match('~[^A-Za-z0-9\-_/, ]~', $string)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Parse & Secure Drive Link
     * @param string $id
     * @param string $url
     * @param int $quality
     * @param int $param
     * @return string
     */
    public static function SourceLink($id, $url, $quality, $param = null)
    {
        global $video, $var;
        $uid = Cache::GetUID($id, $video->source, ($param ?: $var->get->param));
        $url = array(Data::Get("url"), "link", $video->slug, $quality, $uid, null);
        return implode("/", $url);
    }

    /**
     * Add Unique ID with URL
     * @param string $link
     */
    public static function Protect($link)
    {
        global $var, $video;
        if (in_array($video->source, ["drive", "photo"])) {
            $uid = $var->session("fingerprint");
            if (empty($uid)) {
                $uid = md5(microtime());
                $var->setSession("fingerprint", $uid);
            }
            $link .= "?sid=" . $uid;
        }
        return $link;
    }

    /**
     * Return Human Readable Quality Label
     * @param string $fmt
     * @return string|boolean
     */
    public static function Quality($fmt)
    {
        $qualities = explode(",", Data::Get("allowed_qualities"));
        $fmt_lists = array(
            '37' => "1080p",
            '22' => "720p",
            '59' => "480p",
            '18' => "360p",
        );
        $quality = $fmt_lists["$fmt"];
        if (in_array($quality, $qualities)) {
            self::$quality = str_replace("p", null, $quality);
            return strtoupper($quality);
        } else {
            return false;
        }
    }

    /**
     * Store Error Message
     * @param string $error
     */
    public static function Error($error)
    {
        if (empty(self::$error)) {
            self::$error = $error;
        }
    }

    /**
     * Return Stored Error Message
     */
    public static function GetError()
    {
        return self::$error;
    }

    /**
     * Return Web Link From ID
     * @param string $id
     * @param string $source
     */
    public static function Link($id, $source)
    {
        if ($source == "drive") {
            return 'http://drive.google.com/open?id=' . $id;
        } elseif ($source == "photo") {
            $p = json_decode($id, true);
            return "https://photos.google.com/share/{$p["0"]}/photo/{$p["1"]}?key={$p["2"]}";
        } else {
            return false;
        }
    }

    /**
     * Get File 'source' from link
     * @param string $link
     */
    public static function Source($link)
    {
        if (self::isDrive($link)) {
            $source = "drive";
        } elseif (self::isPhotos($link)) {
            $source = "photo";
        } else {
            $source = false;
        }
        return $source;
    }

    /**
     * Get File ID from link
     * @param string $link
     */
    public static function ID($link)
    {
        if (self::isDrive($link)) {
            $id = self::DriveID($link);
        } elseif (self::isPhotos($link)) {
            $id = self::PhotosID($link);
        } else {
            $id = false;
        }
        return $id;
    }

    /**
     * Check if provided link is Google Drive
     * @param  string  $link
     * @return boolean
     */
    public static function isDrive($link)
    {
        $id = self::DriveID($link);
        if (empty($id)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Get File ID from Google Drive Link
     * @param string $link
     */
    public static function DriveID($link)
    {
        $parse = parse_url(trim($link));
        if ($parse["host"] == "docs.google.com" || $parse["host"] == "drive.google.com") {
            parse_str($parse["query"]);
            if (empty($id)) {
                preg_match_all("@d/(.*)/@i", $link, $m);
                $id = $m["1"]["0"];
            }
            return trim($id);
        }
        return false;
    }

    /**
     * Check if provided link is Google Photos
     * @param  string  $link
     * @return boolean
     */
    public static function isPhotos($link)
    {
        $id = self::PhotosID($link);
        if (empty($id)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Get Unique Identifier from Google Photos Link
     * @param string $url
     */
    public static function PhotosID($url)
    {
        $url = trim($url);
        preg_match_all('/^https:\/\/photos.google.com\/share\/(.*?)\/photo\/(.*?)\?key=(.*?)$/U', $url, $m);
        if (!empty($m["1"]["0"]) && !empty($m["2"]["0"]) && !empty($m["3"]["0"])) {
            $id = json_encode(array($m["1"]["0"], $m["2"]["0"], $m["3"]["0"]));
            return $id;
        }
        return false;
    }
}
