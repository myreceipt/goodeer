<?php
namespace IT;

use IT\Tools;

/**
 * Simple HTML wrapper class
 * @package IT\Html
 * @author JuicyCodes
 * @version 1.0.0
 * @created 01-04-2017 10:16 PM
 */
class Html
{
    private $cache        = true;
    private $active       = "dashboard";
    private $class        = "fullscreen-bg";
    private $charset      = "utf-8";
    private $viewport     = "width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0";
    private $title        = "Control Panel";
    private $title_prefix = " | JuicyCodes.Com";
    private $stylesheets  = array();
    private $javascripts  = array();

    /**
     * Generate `<head>` element
     */
    public function GetHeader()
    {
        global $var;

        $head[] = '<!doctype html>';
        $head[] = '<html lang="en" class="' . $this->class . '">';
        $head[] = '<head>';
        $head[] = $this->GetCharset(1);
        $head[] = $this->GetViewport(1);
        $head[] = $this->GetTitle(1);
        $head[] = $this->GetIcon(1);
        $head[] = $this->GetStylesheet(1);
        $head[] = $this->Tab('<script>var ajax_url = "' . $this->Url("ajax") . '";</script>', 1);
        $head[] = '</head>';
        $head[] = '<body>';

        echo implode("\n", $head);
    }

    /**
     * End a HTML page
     */
    public function GetFooter()
    {
        global $var;
        $this->Alerts();
        $head[] = $this->GetJavascript(1);
        if ($this->GetScript(1)) {
            $head[] = $this->GetScript(1);
        }
        $head[] = '</body>';
        $head[] = '</html>';

        echo implode("\n", $head);
    }

    /**
     * Generate navigation menu
     * @param array $menu
     */
    public function Menu($menu)
    {
        $menus = Tools::Object($menu);
        foreach ($menus as $id => $menu) {
            $class   = ($this->active == $id ? "active" : null);
            $child[] = '<li id="menu_' . $id . '">';
            $child[] = $this->Tab('<a href="' . ($menu->link ?: "#") . '" class="' . $class . ' menu_link">', 1);
            if (!empty($menu->icon)) {
                $child[] = $this->Tab('<i class="' . $menu->icon . '"></i>', 2);
            }
            $child[] = $this->Tab('<span>' . $menu->text . '</span>', 2);
            $child[] = $this->Tab('</a>', 1);
            $child[] = '</li>';
            $html[]  = implode("\n", $child);
            unset($child);
        }
        return implode("\n", $html);
    }

    /**
     * Mark a menu as active
     * @param string $id
     */
    public function Active($id)
    {
        $this->active = $id;
        return $this;
    }

    /**
     * Get active class names
     * @param  string $id
     * @param  string $ex
     * @return string
     */
    public function get_class($id, $ex = null)
    {
        $ex .= " menu_link";
        return ($this->active == $id ? "active" : null) . " " . $ex;
    }

    /**
     * Generate character set meta tag
     * @param integer $tab
     */
    private function GetCharset($tab = 0)
    {
        return $this->Tab('<meta charset="' . $this->charset . '">', $tab);
    }

    /**
     * Set charcter set
     * @param string $value
     */
    public function SetCharset($value)
    {
        $this->charset = $value;
        return $this;
    }

    /**
     * Generate viewport meta tag
     * @param integer $tab
     */
    private function GetViewport($tab = 0)
    {
        return $this->Tab('<meta name="viewport" content="' . $this->viewport . '">', $tab);
    }

    /**
     * Seti viewport meta
     * @param [type] $value [description]
     */
    public function SetViewport($value)
    {
        $this->viewport = $value;
        return $this;
    }

    /**
     * Generate `<title>` element
     * @param integer $tab [description]
     */
    private function GetTitle($tab = 0)
    {
        return $this->Tab('<title>' . $this->title . $this->title_prefix . '</title>', $tab);
    }

    /**
     * Set page title
     * @param string $value
     */
    public function SetTitle($value)
    {
        $this->title = $value;
        return $this;
    }

    /**
     * Generate page favicon
     * @param integer $tab
     */
    public function GetIcon($tab = 0)
    {
        global $var;
        $this->icon = $var->url . "/assets/img/juicycodes.ico";
        return $this->Tab('<link rel="icon" type="image/x-icon" href="' . $this->icon . '">', $tab);
    }

    /**
     * Get stylesheet(s)
     * @param integer $tab
     */
    private function GetStylesheet($tab = 0)
    {
        global $var;
        $stylesheets = array();
        foreach ($this->stylesheets as $css) {
            if (Tools::GetHost($css)) {
                $url = $css;
            } else {
                $url = $var->url . $css;
            }
            if ($this->cache == false) {
                $url = $url . "?" . time();
            }
            $stylesheets[] = $this->Tab('<link rel="stylesheet" href="' . $url . '">', $tab);
        }
        return implode("\n", $stylesheets);
    }

    /**
     * Add stylesheet(s)
     * @param string|array $value
     */
    public function AddStylesheet($value)
    {
        if (is_array($value)) {
            foreach ($value as $val) {
                $this->stylesheets[] = $val;
            }
        } else {
            $this->stylesheets[] = $value;
        }
        return $this;
    }

    /**
     * Get javascript(s)
     * @param integer $tab
     */
    private function GetJavascript($tab = 0)
    {
        global $var;
        $javascripts = array();
        foreach ($this->javascripts as $js) {
            if (Tools::GetHost($js)) {
                $url = $js;
            } else {
                $url = $var->url . $js;
            }
            if ($this->cache == false) {
                $url = $url . "?" . time();
            }
            $javascripts[] = $this->Tab('<script src="' . $url . '"></script>', $tab);
        }
        return implode("\n", $javascripts);
    }

    /**
     * Add javascript(s)
     * @param string|array $value
     */
    public function AddJavascript($value)
    {
        if (is_array($value)) {
            foreach ($value as $val) {
                $this->javascripts[] = $val;
            }
        } else {
            $this->javascripts[] = $value;
        }
        return $this;
    }

    /**
     * Get `<script>` elemt
     * @param integer $tab
     */
    public function GetScript($tab = 0)
    {
        if (empty($this->script)) {
            return null;
        }
        $script[] = $this->Tab('<script>', $tab);
        $script[] = $this->Tab($this->script, $tab);
        $script[] = $this->Tab('</script>', $tab);
        return implode(" ", $script);
    }

    /**
     * Add javascript code
     * @param string $value
     */
    public function Script($value)
    {
        if (empty($this->script)) {
            $this->script = $value;
        } else {
            $this->script .= $value;
        }
        return $this;
    }

    /**
     * Redirect a page to given URL
     * @param strinf  $url
     * @param boolean $exit
     */
    public function Redirect($url, $exit = false)
    {
        header("Location: $url");
        if ($exit) {
            exit;
        }
        return $this;
    }

    /**
     * Redirect page to referer
     * @param boolean $exit
     */
    public function GoBack($exit = false)
    {
        return $this->Redirect($_SERVER["HTTP_REFERER"], $exit);
    }

    /**
     * Generate full URL
     * @param  string $path
     * @return string
     */
    public function url($path)
    {
        global $var;
        $url = $var->url . '/' . $path;
        if (!empty($path)) {
            $url .= '/';
        }
        return $url;
    }

    /**
     * Create an HTML element
     * @param  string  $elem
     * @param  array|boolean   $attr
     * @param  array|boolean   $data
     * @param  boolean $echo
     * @param  array|boolean   $condition
     * @param  boolean $close
     * @return string
     */
    public function element($elem, $attr = array(), $data = array(), $echo = false, $condition = array(), $close = true)
    {
        if (!empty($attr)) {
            foreach ($attr as $att => $val) {
                $attrs[] = $att . '="' . $val . '"';
            }
        }

        $html = "<$elem ";
        if (!empty($attrs)) {
            $html .= implode(" ", $attrs);
        }
        $html .= '>';
        $html .= implode(null, $data);
        if ($close) {
            $html .= "</$elem>";
        }
        if (!empty($condition)) {
            foreach ($condition as $key => $value) {
                if ($value["1"] == "!=") {
                    if ($value["0"] == $value["2"]) {
                        $ce[] = $key;
                    }
                } elseif ($value["1"] == "==") {
                    if ($value["0"] != $value["2"]) {
                        $ce[] = $key;
                    }
                } elseif (empty($value["1"])) {
                    if ($value["0"] === false) {
                        $ce[] = $key;
                    }
                }
            }
            if (count($ce) > 0) {
                return;
            }
        }
        if ($echo) {
            echo $html;
        } else {
            return $html;
        }
    }

    /**
     * Create an <input> element
     * @param  string  $type
     * @param  string  $class
     * @param  boolean|string $id
     * @param  string  $name
     * @param  boolean|string $value
     * @param  boolean|string $placeholder
     * @return string
     */
    public function input($type = "text", $class = "form-control", $id = false, $name, $value = false, $placeholder = false)
    {
        $html = '<input type="' . $type . '"';
        if ($class) {
            $html .= ' class="' . $class . '"';
        }
        if ($id) {
            $html .= ' id="' . $id . '"';
        }
        if ($name) {
            $html .= ' name="' . $name . '"';
        }

        if ($placeholder) {
            if (is_bool($placeholder)) {
                $placeholder = $value;
                $value       = false;
            }
            $html .= ' placeholder="' . $placeholder . '"';
        }

        if ($value) {
            $html .= ' value="' . $value . '"';
        }
        $html .= '>';
        return $html;
    }

    /**
     * Create an checkbox input
     * @param  string  $class
     * @param  boolean|string $id
     * @param  string  $name
     * @param  boolean|string $d_value
     * @param  boolean|string $n_value
     * @param  boolean|string $label
     * @return string
     */
    public function checkbox($class = "checkbox", $id = false, $name, $d_value = false, $n_value = false, $label = false)
    {
        $checkbox = '<input type="checkbox"';
        if ($id) {
            $checkbox .= ' id="' . $id . '"';
        }
        if ($name) {
            $checkbox .= ' name="' . $name . '"';
        }
        if ($d_value) {
            $checkbox .= ' value="' . $d_value . '"';
        }
        if ($d_value == $n_value) {
            $checkbox .= ' checked="checked"';
        }
        $checkbox .= '>';

        if ($class == "fancy-checkbox") {
            $html = '<label class="' . $class . '">' . $checkbox . '<span>' . $label . '</span></label>';
        } else {
            $html = '<div class="' . $class . '"><label>' . $checkbox . $label . '</label></div>';
        }
        return $html;
    }

    /**
     * Set a label for an <input> element
     * @param  boolean|string $id
     * @param  string  $class
     * @param  boolean|string $text
     * @return string
     */
    public function label($id = false, $class = "control-label", $text = false)
    {
        $html = '<label';
        if ($id) {
            $html .= ' for="' . $id . '"';
        }
        if ($class) {
            $html .= ' class="' . $class . '"';
        }
        $html .= ">";
        if ($text) {
            $html .= $text . ":";
        }
        $html .= "</label>";
        return $html;
    }

    /**
     * Add tip for an <input> element
     * @param  string $text
     * @return string
     */
    public function tip($text)
    {
        return ' <i class="fa fa-info-circle text-muted" data-toggle="tooltip" title="' . $text . '"></i>';
    }

    /**
     * Add an option in a select list
     * @param  string  $text
     * @param  string  $value
     * @param  boolean|string $sel
     * @param  boolean $multi
     * @return string
     */
    public function option($text, $value, $sel = false, $multi = false)
    {
        if ($multi && $sel) {
            $options = explode(",", $sel);
            $param   = (in_array($value, $options) ? ' selected="selected"' : null);
        } else {
            $param = ($value == $sel ? ' selected="selected"' : null);
        }
        return '<option value="' . $value . '"' . $param . '>' . $text . '</option>';
    }

    /**
     * Create an action button
     * @param  string $href
     * @param  string $class
     * @param  string $icon
     * @param  string $text
     * @param  boolean $confirm
     * @return string
     */
    public function action($href = false, $class = false, $icon = false, $text = false, $confirm = false)
    {
        $html .= "<a";
        if (!empty($href)) {
            $html .= ' href="' . $href . '"';
        }
        if ($confirm && $href == true) {
            $html .= ' onclick="return jc_confirm(this);"';
        }
        if (!empty($class)) {
            $html .= ' class="btn btn-xs btn-' . $class . '"';
        }
        $html .= ">";
        if (!empty($icon)) {
            $html .= '<i class="' . $icon . '"></i>';
        }
        if (!empty($text)) {
            $html .= " " . $text;
        }
        $html .= "</a> ";
        return $html;
    }

    /**
     * Show a HTML alert
     * @param  string $msg
     * @param  string $type
     * @param  string $align
     * @return string
     */
    public function alert($msg, $type, $align = 'left')
    {
        return '<div class="alert alert-' . $type . ' text-' . $align . '" role="alert">' . $msg . '</div>';
    }

    /**
     * Show `toastr` alert(s)
     */
    private function Alerts()
    {
        global $var;
        if (!empty($var->session("success"))) {
            $this->Script('toastr.success("' . $var->session("success") . '");');
            $var->remove_session("success");
        }

        if (!empty($var->session("error"))) {
            $this->Script('toastr.error("' . $var->session("error") . '");');
            $var->remove_session("error");
        }

        if (!empty($var->session("info"))) {
            $this->Script('toastr.info("' . $var->session("info") . '");');
            $var->remove_session("info");
        }
    }

    /**
     * Hightlight a portion of text
     * @param  string  $text
     * @param  string|boolean $match
     * @return string
     */
    public function highlight($text, $match = false)
    {
        if (empty($match)) {
            return $text;
        } else {
            return preg_replace("/($match)/i", "<code>$1</code>", $text);
        }
    }

    /**
     * Create a session named "success"
     * @param  string $val
     * @return object
     */
    public function success($val)
    {
        global $var;
        $var->setSession("success", $val);
        return $this;
    }

    /**
     * Create a session name "error"
     * @param  string $val
     * @return object
     */
    public function error($val)
    {
        global $var;
        $var->setSession("error", $val);
        return $this;
    }

    /**
     * Create a session name "info"
     * @param  string $val
     * @return object
     */
    public function info($val)
    {
        global $var;
        $var->setSession("info", $val);
        return $this;
    }

    /**
     * Add a tab infront of given string
     * @param string $html
     * @param int $tab
     */
    private function Tab($html, $tab)
    {
        $tabs = str_repeat("\t", $tab);
        return $tabs . $html;
    }
}
