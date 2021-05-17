<?php
if (!defined("JUICYCODES")) {
    exit;
}
use IT\Tools;
if ($user->Info("role") != "1") {
    $html->error("Access denied - You are not authorized to access this page!")->Redirect($html->Url(""), true);
}
$html->active("manage_users")->SetTitle("Manage Users");
require_once ADMINPATH . '/header.php';
if (!empty($var->get->jc_q)) {
    $search = "WHERE name LIKE '%{$var->get->jc_q}%' OR email LIKE '%{$var->get->jc_q}%'";
}
$uss = $db->query("SELECT * FROM users $search LIMIT {$paginator->start},{$paginator->limit}");
$tot = $db->query("SELECT * FROM users $search");
if ($uss->num_rows < 1) {
    $user_table = $html->alert("No result found!", "default no-margins no-radius", "center");
} else {
    while ($us = $uss->fetch_object()) {
        $links   = $db->query("SELECT id FROM files WHERE user='{$us->id}'");
        $users[] = $html->element("tr", false, array(
            $html->element("td", false, array($us->id)),
            $html->element("td", false, array($html->highlight($us->name, $var->get->jc_q))),
            $html->element("td", false, array($html->highlight($us->email, $var->get->jc_q))),
            $html->element("td", false, array($html->element("span", array("class" => "badge"), array(number_format($links->num_rows))))),
            $html->element("td", false, array(Tools::Role($us->role))),
            $html->element("td", false, array(Tools::Status($us->status))),
            $html->element("td", false, array($var->date("d M, Y", $us->date))),
            $html->element("td", false, array(
                $html->action($html->url("user/edit/{$us->id}"), "info", "fa fa-pencil", "EDIT"),
                ($us->status == "1" ?
                    $html->action($html->url("user/ban/{$us->id}"), "warning", "fa fa-ban", "BAN", true) :
                    $html->action($html->url("user/unban/{$us->id}"), "success", "fa fa-check", "UNBAN", true)
                ),
                $html->action($html->url("user/delete/{$us->id}"), "danger", "fa fa-trash", "DELETE", true),
            )),
        ));
    }
    $user_table = $html->element("div", array("class" => "table-responsive"), array(
        $html->element("table", array("class" => "table table-striped no-margins"), array(
            $html->element("thead", false, array(
                $html->element("tr", false, array(
                    $html->element("th", array("width" => "10px"), array("#ID")),
                    $html->element("th", false, array("Name")),
                    $html->element("th", false, array("Email")),
                    $html->element("th", false, array("Links")),
                    $html->element("th", false, array("Role")),
                    $html->element("th", false, array("Status")),
                    $html->element("th", false, array("Joined")),
                    $html->element("th", array("width" => "220px"), array("Actions")),
                )),
            )),
            $html->element("tbody", false, $users),
        )),
    ));
}

$html->element("div", array("class" => "panel"), array(
    $html->element("div", array("class" => "panel-heading"), array(
        $html->element("h3", array("class" => "panel-title"), array("MANAGE USERS")),
        $html->element("div", array("class" => "right"), array(
            $html->element("a", array("class" => "btn btn-primary btn-sm", "href" => $html->url("add/user")), array("Add User")),
        )),
    )),
    $html->element("div", array("class" => "panel-body no-padding"), array(
        $user_table,
    )),
    $html->element("div", array("class" => "panel-footer"), array(
        $html->element("div", array("class" => "row"), array(
            $html->element("div", array("class" => "col-md-3"), array(
                $html->element("form", array("method" => "get", "action" => $html->url("manage/users")), array(
                    $html->element("div", array("class" => "input-group"), array(
                        $html->input("text", "form-control input-sm", "jc_q", "jc_q", $var->get->jc_q, "Search Users By Name OR Email..."),
                        $html->element("span", array("class" => "input-group-btn"), array(
                            $html->element("button", array("type" => "submit", "class" => "btn btn-info btn-sm"), array("Search")),
                        )),
                    )),
                )),
            )),
            $html->element("div", array("class" => "col-md-9 text-right"), array(
                $paginator->show($tot->num_rows, $var->get->page),
            )),
        )),
    )),
), true);
require_once ADMINPATH . '/footer.php';
