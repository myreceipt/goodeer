<?php
if (!defined("JUICYCODES")) {
    exit;
}
if ($user->Info("role") != "1") {
    if ($var->get->id != $user->info("id")) {
        $html->error("Access denied - You are not authorized to access this page!")->Redirect($html->Url(""), true);
    }
}
$html->active("manage_users")->SetTitle("Add Users");
$info = $user->Info("*", $var->get->id);
if (empty($info)) {
    $html->error("Invalid User Selected!")->Redirect($html->Url("manage/users"), true);
}
require_once ADMINPATH . '/header.php';
$html->element("div", array("class" => "panel"), array(
    $html->element("div", array("class" => "panel-heading"), array(
        $html->element("h3", array("class" => "panel-title"), array("EDIT USER")),
        $html->element("div", array("class" => "right"), array(
            $html->element("a", array("class" => "btn btn-primary btn-sm", "href" => $html->url("manage/users")), array("Manage Users")),
        )),
    )),
    $html->element("form", array("method" => "post", "action" => $html->Url("actions")), array(
        $html->input("hidden", "hide", false, "action", "edit_user"),
        $html->input("hidden", "hide", false, "id", $var->get->id),
        $html->element("div", array("class" => "panel-body"), array(
            $html->element("div", array("class" => "row"), array(
                $html->element("div", array("class" => "col-lg-4 col-md-6"), array(
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("jc_name", "control-label", "User Full Name"),
                        $html->tip("Insert User Full Name"),
                        $html->input("text", "form-control", "jc_name", "jc_name", $info->name, "Insert User Full Name"),
                    )),
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("jc_email", "control-label", "User Email"),
                        $html->tip("Insert User Email"),
                        $html->input("text", "form-control", "jc_email", "jc_email", $info->email, "Insert User Email"),
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
                            $html->option("-- Select A Role --", "0", $info->role),
                            $html->option("Admin", "1", $info->role),
                            $html->option("Author", "2", $info->role),
                        )),
                    )),
                )),
            )),
        )),
        $html->element("div", array("class" => "panel-footer"), array(
            $html->element("button", array("type" => "submit", "class" => "btn btn-info"), array("EDIT USER")),
        )),
    )),
), true);
require_once ADMINPATH . '/footer.php';
