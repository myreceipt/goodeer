<?php
namespace IT;

/**
 * Simple error handler
 * @package IT\Error
 * @version 1.0.0
 * @created 01-04-2017 10:04 PM
 */
class Error
{
    private $errors = array();

    /**
     * Add Error
     * @param string $error
     */
    public function add($error)
    {
        $this->errors[] = $error;
    }

    /**
     * Check if there is any error
     * @return boolean
     */
    public function is_empty()
    {
        if (count($this->errors) == "0") {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Return Error messages in ARRAY
     * @return array
     */
    public function get()
    {
        return $this->errors;
    }

    /**
     * Return Errors messages
     * @return string
     */
    public function show()
    {
        global $html;
        if ($this->is_empty()) {
            return null;
        } else {
            return $html->alert(implode("<br/>", $this->errors), "danger");
        }
    }

    /**
     * Return Error messages in JSON
     * @param  string $append
     * @return string
     */
    public function json($append = false)
    {
        header('Content-Type: application/json');
        if ($append) {
            $return = $append;
            if (count($this->errors) != "0") {
                $return["errors"] = $this->errors;
            }
            echo json_encode($return);
        } else {
            echo json_encode($this->errors);
        }
    }

    /**
     * Vaildate Input
     * @param  string  $type
     * @param  string  $values
     * @param  boolean $empty
     * @return object
     */
    public function vaildate($type, $values, $empty = false)
    {
        global $var;

        if ($empty) {
            if (!$this->is_empty()) {
                return $this;
            }
        }
        if ($type = "post") {
            $data = $var->post;
        } elseif ($type == "get") {
            $data = $var->get;
        } else {
            return;
        }
        foreach ($values as $tok => $value) {
            if ($value["compare"] == "length") {
                $length = strlen($data->{$tok});
                if ($length < $value["length"]["min"]) {
                    $this->add($value["error"]["min"]);
                } elseif ($length > $value["length"]["max"]) {
                    $this->add($value["error"]["max"]);
                }
            } elseif ($value["compare"] == "==") {
                if ($data->{$tok} != $value["string"]) {
                    $this->add($value["error"]);
                }
            } elseif ($value["compare"] == "not_in") {
                if (!in_array($data->{$tok}, $value["string"])) {
                    $this->add($value["error"]);
                }
            } elseif ($value["compare"] == "captcha") {
                if (!$this->verifyCaptcha($data->{$tok})) {
                    $this->add($value["error"]);
                }
            } else {
                if (empty($data->{$tok})) {
                    $this->add($value["error"]);
                }
            }
        }
        return $this;
    }
}
