<?php
if (!defined("JUICYCODES")) {
    exit;
}
if ($user->Info("role") != "1") {
    $html->error("Access denied - You are not authorized to access this page!")->Redirect($html->Url(""), true);
}
$html->active("manage_users")->SetTitle("Add Users");
require_once ADMINPATH . '/header.php';
$html->element("div", array("class" => "panel"), array(
    $html->element("div", array("class" => "panel-heading"), array(
        $html->element("h3", array("class" => "panel-title"), array("ADD NEW USER")),
        $html->element("div", array("class" => "right"), array(
            $html->element("a", array("class" => "btn btn-primary btn-sm", "href" => $html->url("manage/users")), array("Manage Users")),
        )),
    )),
    $html->element("form", array("method" => "post", "action" => $html->Url("actions")), array(
        $html->input("hidden", "hide", false, "action", "add_user"),
        $html->element("div", array("class" => "panel-body"), array(
            $html->element("div", array("class" => "row"), array(
                $html->element("div", array("class" => "col-lg-4 col-md-6"), array(
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("jc_name", "control-label", "User Full Name"),
                        $html->tip("Insert User Full Name"),
                        $html->input("text", "form-control", "jc_name", "jc_name", "Insert User Full Name", true),
                    )),
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("jc_email", "control-label", "User Email"),
                        $html->tip("Insert User Email"),
                        $html->input("text", "form-control", "jc_email", "jc_email", "Insert User Email", true),
                    )),
                )),
            )),
            $html->element("div", array("class" => "row"), array(
                $html->element("div", array("class" => "col-lg-2 col-md-3"), array(
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("jc_pass", "control-label", "User Password"),
                        $html->tip("Insert User Password"),
                        $html->input("text", "form-control", "jc_pass", "jc_pass", "Insert User Password", true),
                    )),
                )),
                $html->element("div", array("class" => "col-lg-2 col-md-3"), array(
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("jc_role", "control-label", "User Role"),
                        $html->tip("Select User Role"),
                        $html->element("select", array("class" => "form-control", "id" => "jc_role", "name" => "jc_role"), array(
                            $html->option("-- Select A Role --", "0"),
                            $html->option("Admin", "1"),
                            $html->option("Author", "2"),
                        )),
                    )),
                )),
            )),
        )),
        $html->element("div", array("class" => "panel-footer"), array(
            $html->element("button", array("type" => "submit", "class" => "btn btn-info"), array("ADD USER")),
        )),
    )),
), true);
require_once ADMINPATH . '/footer.php';
