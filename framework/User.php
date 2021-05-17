<?php
namespace IT;

/**
 * Simple User management class
 * @package IT\User
 * @author JuicyCodes
 * @version 1.0.1
 * @created 01-04-2017 10:57 PM
 * @modified 04-04-2017 03:48 AM
 */
class User
{
    public $id;
    private $user;
    private $season_id;
    public $current_user;

    /**
     * Set some startup variables
     * @param string $season_id
     */
    public function __construct($season_id = false)
    {
        $this->season_id = $season_id ?: $this->session_id();
        if ($this->Logged()) {
            $this->id = $_SESSION[$this->season_id];
        }
    }

    /**
     * Return user info
     * @param string  $col
     * @param boolean|int $id
     */
    public function Info($col, $id = false)
    {
        global $db;
        $id = $id ?: $this->id;
        if (empty($this->info[$id])) {
            $users = $db->select("users", true, array("id" => $id));
            if ($users->num_rows == "1") {
                $this->info[$id] = $users->fetch_assoc();
            } else {
                return false;
            }
        }
        if ($col == "*") {
            return Tools::Object($this->info[$id]);
        } else {
            return $this->info[$id][$col];
        }
    }

    /**
     * Return user avatar
     */
    public function Avatar()
    {
        global $var;
        $name = md5($this->id . "_profile");
        if (!file_exists(ADMINPATH . "/assets/img/$name.png")) {
            return $var->url . "/assets/img/profile.png";
        } else {
            return $var->url . "/assets/img/$name.png";
        }

    }

    /**
     * Check if a user with this email already exists
     * @param string $id
     */
    public function Exists($id)
    {
        global $db;
        if (empty($id)) {
            return false;
        }

        if (is_numeric($id)) {
            $col = "id";
        } elseif ($this->isEmail($id)) {
            $col = "email";
        } else {
            $col = "username";
        }
        $cols = [$col, "pass"];
        if ($col != "id") {
            $cols[] = "id";
        }
        $users = $db->select("users", $cols, array("$col" => $id));
        if ($users->num_rows != "1") {
            return false;
        }
        $this->user = $users->fetch_object();
        if (empty($this->current_user)) {
            $this->current_user = $this->user->id;
        }
        return true;
    }

    /**
     * Log In a user
     * @param string $url
     */
    public function Login($url = false)
    {
        $_SESSION[$this->season_id] = $this->id = $this->user->id;
        if (!empty($url)) {
            header("Location: $url");
            exit;
        }
    }

    /**
     * Log Out a user
     * @param boolean $url
     */
    public function Logout($url = false)
    {
        unset($_SESSION[$this->season_id]);
        if (!empty($url)) {
            header("Location: $url");
            exit;
        }
    }

    /**
     * Whether user is looged in or not
     * @param boolean $url
     */
    public function CheckLogin($url = false)
    {
        global $html;
        if ($this->Logged()) {
            if ($this->Info("status") != "1") {
                $html->error("Your account is banned!");
                $this->Logout($html->url("login"));
            }
            return true;
        } else {
            if (!empty($url)) {
                header("Location: $url");
                exit;
            }
            return false;
        }
    }

    /**
     * Simple login checker
     */
    public function Logged()
    {
        if (empty($_SESSION[$this->season_id])) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * Verifies that a password matches a hash
     * @param string  $pass
     * @param boolean|string $hash
     */
    public function CheckPassword($pass, $hash = false)
    {
        if (empty($hash)) {
            $hash = $this->user->pass;
        }
        if (empty($pass) || empty($hash)) {
            return false;
        }
        return password_verify($pass, $hash);
    }

    /**
     * Creates a password hash
     * @param string $password
     */
    public function Password($password)
    {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
     * Filters a variable with a email filter
     * @param  string  $email
     * @return boolean
     */
    public function isEmail($email)
    {
        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Generate a session ID
     * @return string
     */
    private function session_id()
    {
        return md5(__FILE__ . "_" . $_SERVER["HTTP_HOST"]);
    }
}
