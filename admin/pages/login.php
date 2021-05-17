<?php
require 'init.php';
use IT\Data;
use IT\IP;

if ($user->Logged()) {
    $html->Redirect($html->url(null));
}

if ($var->post->__total == "2") {
    $error
        ->vaildate("post", array(
            "jc_email"    => array(
                "error" => "Please write your email address",
            ),
            "jc_password" => array(
                "error" => "Please write your password",
            ),
        ));
    if ($error->is_empty() && !$user->Exists($var->post->jc_email)) {
        $error->add("Invalid User Credentials!");
    }
    if ($error->is_empty() && !$user->CheckPassword($var->post->jc_password)) {
        $error->add("Invalid User Credentials!");
    }
    if ($error->is_empty()) {
        if (Data::Get("login_log") == "enable") {
            $ip = IP::Details();
            $db->insert("loginlog", array(
                "uid"      => $user->current_user,
                "info"     => json_encode($ip),
                "datetime" => $var->timestamp(),
            ));
        }
        $user->Login($html->url(null));
    }
}

$html->GetHeader();
$html->element("div", array("id" => "wrapper"), array(
    $html->element("div", array("class" => "vertical-align-wrap"), array(
        $html->element("div", array("class" => "vertical-align-middle"), array(
            $html->element("div", array("class" => "auth-box"), array(
                $html->element("div", array("class" => "logo text-center"), array(
                    $html->element("img", array("src" => $var->url . "/assets/img/juicycodes.png", "alt" => "JUICYCODES.COM")),
                )),
                $html->element("div", array("class" => "content"), array(
                    $error->show(),
                    $html->element("form", array("method" => "post", "class" => "form-auth-small"), array(
                        $html->element("div", array("class" => "form-group"), array(
                            $html->label("jc_email", "control-label", "Email"),
                            $html->input("email", "form-control", "jc_email", "jc_email", "Enter your email address", true),
                        )),
                        $html->element("div", array("class" => "form-group"), array(
                            $html->label("jc_password", "control-label", "Password"),
                            $html->input("password", "form-control", "jc_password", "jc_password", "Enter your password", true),
                        )),
                        $html->element("div", array("class" => "form-group"), array(
                            $html->element("button", array("type" => "submit", "class" => "btn btn-success btn-lg btn-block"), array("LOGIN")),
                        )),
                    )),
                )),
            )),
            $html->element("div", array("class" => "juicycodes"), array(
                "Made with ",
                $html->element("i", array("class" => "fa fa-heart heart")),
                " by ",
                $html->element("a", array("href" => "https://juicycodes.com"), array("JUICYCODES.COM")),
                ".",
            )),
        )),
    )),
), true);
$html->GetFooter();
