<?php
namespace IT;

/**
 * Simple Variable Parser
 * @package IT\Variables
 * @version 1.0.1
 * @created 28-03-2017 03:06 AM
 * @modified 01-06-2017 09:59 PM
 */
class Variables
{
    public $get;
    public $post;

    public function __construct()
    {
        $this->parse_get();
        $this->parse_post();
        $this->set_session_id();
        $this->date      = $this->date();
        $this->time      = $this->time();
        $this->timestamp = $this->timestamp();
    }

    /**
     * Parse GET request data to escape special character
     * @param  array $data
     * @return object
     */
    public function parse_get($data = false)
    {
        $get   = $_GET;
        $count = 0;
        if ($data) {
            $get = array_merge($get, $data);
        }
        foreach ($get as $key => $value) {
            $this->get->{$key} = $this->sanitize($value);
            $count++;
        }
        $this->get->__total = $count;
        return $this;
    }

    /**
     * Parse POST request data to escape special character
     * @param  array $data
     * @return object
     */
    public function parse_post($data = false)
    {
        $post  = $_POST;
        $count = 0;
        if ($data) {
            $post = array_merge($post, $data);
        }
        foreach ($post as $key => $value) {
            $this->post->{$key} = $this->sanitize($value);
            $count++;
        }
        $this->post->__total = $count;
        return $this;
    }

    /**
     * Send a cookie
     * @param string  $name
     * @param string  $value
     * @param boolean|int $expire
     */
    public function setCookie($name, $value, $expire = false)
    {
        if (!$expire) {
            $expire = (3600 * 240);
        }
        setcookie($name, $value, time() + $expire, '/');
    }

    /**
     * Get a sanitized cookie value
     * @param  string $name
     * @return string
     */
    public function cookie($name)
    {
        return $this->sanitize($_COOKIE["$name"]);
    }

    /**
     * Set session
     * @param string $id
     * @param string $val
     */
    public function setSession($id, $val)
    {
        $_SESSION[$this->session_id . "_" . $id] = $val;
        return $this;
    }

    /**
     * Get sanitized session value
     * @param  string $id
     * @return string
     */
    public function session($id, $sanitize = false)
    {
        if ($sanitize) {
            return $this->sanitize($_SESSION[$this->session_id . "_" . $id]);
        } else {
            return $_SESSION[$this->session_id . "_" . $id];
        }
    }

    /**
     * Unset / Remove Session
     * @param  string $id
     * @return object
     */
    public function remove_session($id)
    {
        unset($_SESSION[$this->session_id . "_" . $id]);
        return $this;
    }

    /**
     * Set Unique Session Name Prefix
     */
    private function set_session_id()
    {
        $this->session_id = md5(__FILE__ . "_" . $_SERVER["HTTP_HOST"]);
    }

    /**
     * Returns a formatted date string
     * @param  string $format The format of the outputted date string
     * @param  string $sec
     * @return string
     */
    public function date($format = "Y-m-d", $sec = false)
    {
        if ($sec === false) {
            return date($format);
        } elseif (is_numeric($sec)) {
            return date($format, $sec);
        } else {
            if (empty($sec)) {
                return "N/A";
            }
            return date($format, strtotime($sec));
        }
    }

    /**
     * Return current Unix timestamp
     * @return int
     */
    public function time()
    {
        return time();
    }

    /**
     * Returns a datetime string
     * @return string
     */
    public function timestamp()
    {
        return date("Y-m-d H:i:s");
    }

    /**
     * Escapes special characters in a string for use in an SQL statement.
     * @param  string $value
     * @return string
     */
    public function sanitize($value)
    {
        global $db;
        if (is_array($value)) {
            return $value;
        } else {
            if (!$db->mysqli->connect_error) {
                $sanitized = addslashes($db->mysqli->real_escape_string($value));
            } else {
                $sanitized = addslashes($value);
            }
            return $sanitized;
        }
    }
}
