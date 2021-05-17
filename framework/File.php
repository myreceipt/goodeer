<?php
namespace IT;

use IT\Tools;

/**
 * Simple $_FILE management class
 * @package IT\File
 * @author JuicyCodes
 * @version 1.0.0
 * @created 01-04-2017 10:06 PM
 */
class File
{
    private static $files;

    /**
     * Get a File Upload variable
     * @param string $name
     */
    public static function Get($name)
    {
        global $var;
        if (empty(self::$files->{$name})) {
            foreach ($_FILES["$name"] as $key => $value) {
                self::$files[$name]["$key"] = ($key == "name" ? $var->sanitize($value) : $value);
            }
            self::$files = Tools::Object(self::$files);
        }
        return self::$files->{$name};
    }

    /**
     * Moves an uploaded file to a new location
     * @param string  $file
     * @param string  $path
     * @param boolean $delete
     */
    public static function Upload($file, $path, $delete = false)
    {
        if ($delete) {
            if (file_exists($path)) {
                unlink($path);
            }
        }
        if (file_exists($file)) {
            $file = $file;
        } else {
            $file = $_FILES["$file"]["tmp_name"];
        }
        if (move_uploaded_file($file, $path)) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * HTTP File Upload variables
     */
    public static function All()
    {
        return $_FILES;
    }

    /**
     * Reorder the $_FILES array
     * @param string $file
     */
    public static function Reverse($file)
    {
        $files = array();
        $count = count($file['name']);
        $keys  = array_keys($file);
        for ($i = 0; $i < $count; $i++) {
            foreach ($keys as $key) {
                $files[$i][$key] = $file[$key][$i];
            }
        }
        return $files;
    }
}
