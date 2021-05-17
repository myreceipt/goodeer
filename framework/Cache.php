<?php
namespace IT;

use IT\Data;

/**
 * Simple Cache Management Class
 * @package IT\Cache
 * @author JuicyCodes
 * @version V3.6.0
 * @created 12-12-16 2:43:23 PM
 * @modified 30-06-2017 12:20 AM
 */
class Cache
{
    private static $video, $source, $type;

    /**
     * Get a cached video
     * @param string $video
     * @param string $source
     * @param string $type
     */
    public static function Get($video, $source, $type)
    {
        global $db, $var;
        $uid    = self::GetUID($video, $source, $type);
        $type   = self::GetType();
        $cached = $db->query("SELECT data,expiry FROM cache WHERE uid='{$uid}' AND type='{$type}'");
        if ($cached->num_rows == "1") {
            $cache = $cached->fetch_object();
            if ($cache->expiry > $var->time()) {
                return json_decode($cache->data);
            } else {
                $db->delete("cache", array("uid" => $uid, "type" => $type));
            }
        }
        return false;
    }

    /**
     * Cache a given video
     * @param object $data
     * @param bollean $remove
     */
    public static function Store($data, $remove = false)
    {
        global $db, $var;
        $uid     = self::GetUID();
        $type    = self::GetType();
        $created = $var->time();
        if (!empty($data->sources) && self::GetType() != "_" && Data::Get("caching") == "on") {
            if ($remove === true) {
                $db->delete("cache", array("uid" => $uid, "type" => $type));
            }
            $db->insert("cache", array(
                "uid"     => $uid,
                "data"    => json_encode($data),
                "type"    => $type,
                "created" => $created,
                "expiry"  => ($created + self::Expiry()),
            ));
        }
    }

    /**
     * Store Google Drive links
     * @param object $data
     * @param string $video
     * @param string $source
     * @param string $type
     */
    public static function Links($data, $video, $source, $type)
    {
        global $db, $var;
        if (in_array($source, ["drive", "photo"]) && !empty($data->orginal)) {
            $uid   = self::GetUID($video, $source, $type);
            $data  = array("sources" => $data->orginal, "cookies" => $data->cookies);
            $links = $db->query("SELECT uid FROM links WHERE uid='{$uid}'");
            if ($links->num_rows == "1") {
                $db->update("links", array("data" => json_encode($data), "added" => $var->time()), array("uid" => $uid));
            } else {
                $db->insert("links", array("uid" => $uid, "data" => json_encode($data), "type" => $type, "added" => $var->time()));
            }
        }
        return false;
    }

    /**
     * Return Unique ID
     * @param string $video
     * @param string $source
     * @param string $type
     * @param boolean $clear
     */
    public static function GetUID($video = null, $source = null, $type = null, $clear = false)
    {
        if ($clear === true) {
            self::$video = self::$source = self::$type = null;
        }
        if (empty(self::$video) && empty(self::$source) && empty(self::$type)) {
            self::$type   = $type;
            self::$video  = $video;
            self::$source = $source;
        }
        return md5(implode("_", [self::$video, self::$source, self::$type]));
    }

    /**
     * Return Video Type
     */
    public static function GetType()
    {
        return implode("_", [self::$source, self::$type]);
    }

    /**
     * Return Cache Expiry Time
     */
    public static function Expiry()
    {
        return (Data::Get("cache_expire") * 3600);
    }
}
