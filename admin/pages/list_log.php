<?php
if (!defined("JUICYCODES")) {
    exit;
}
use IT\Data;

if ($user->Info("role") != "1") {
    $html->error("Access denied - You are not authorized to access this page!")->Redirect($html->Url(""), true);
}
$html->active("list_log")->SetTitle("Login Log");
require_once ADMINPATH . '/header.php';
if (!empty($var->get->id)) {
    $search = "WHERE uid='{$var->get->id}'";
}
$logs = $db->query("SELECT * FROM loginlog $search ORDER BY datetime DESC LIMIT {$paginator->start},{$paginator->limit}");
$tot  = $db->query("SELECT * FROM loginlog $search");
if ($logs->num_rows < 1) {
    $log_table = $html->alert("No result found!", "default no-margins no-radius", "center");
} else {
    while ($log = $logs->fetch_object()) {
        $info       = json_decode($log->info);
        $log_logs[] = $html->element("tr", false, array(
            $html->element("td", false, array(
                $html->element("a", array("href" => $html->Url("log/user/{$log->uid}")), array(
                    "#" . $log->uid,
                )),
            )),
            $html->element("td", false, array(
                $html->element("a", array("href" => $html->Url("log/user/{$log->uid}")), array(
                    $user->Info("name", $log->uid),
                )),
            )),
            $html->element("td", false, array($info->query)),
            $html->element("td", false, array($info->country)),
            $html->element("td", false, array(
                $html->element("a", array("href" => "#!", "class" => "btn btn-primary btn-xs more_info", "data-info" => rawurlencode($log->info)), array(
                    $html->element("i", array("class" => "fa fa-info-circle")),
                    " More Info",
                )),
            )),
            $html->element("td", false, array($var->date("d M, Y h:i A", $log->datetime))),
        ));
    }
    $log_table = $html->element("div", array("class" => "table-responsive"), array(
        $html->element("table", array("class" => "table table-striped no-margins"), array(
            $html->element("thead", false, array(
                $html->element("tr", false, array(
                    $html->element("th", array("width" => "80px"), array("UID")),
                    $html->element("th", false, array("User Name")),
                    $html->element("th", false, array("IP")),
                    $html->element("th", false, array("Country")),
                    $html->element("th", false, array("More Info")),
                    $html->element("th", false, array("Login Time")),
                )),
            )),
            $html->element("tbody", false, $log_logs),
        )),
    ));
}

$html->element("div", array("class" => "panel"), array(
    $html->element("div", array("class" => "panel-heading"), array(
        $html->element("h3", array("class" => "panel-title"), array("LOGIN LOG")),
        $html->element("div", array("class" => "right"), array(
            $html->element("a", array("class" => "btn btn-info btn-xs", "href" => $html->url("log/disable")), array("DISABLE LOG"), false, array(
                array(Data::Get("login_log"), "==", "enable"),
            )),
            $html->element("a", array("class" => "btn btn-success btn-xs", "href" => $html->url("log/enable")), array("ENABLE LOG"), false, array(
                array(Data::Get("login_log"), "!=", "enable"),
            )),
            " ",
            $html->element("a", array("class" => "btn btn-danger btn-xs", "href" => $html->url("log/clear")), array("CLEAR LOG")),
        )),
    )),
    $html->element("div", array("class" => "panel-body no-padding"), array(
        $log_table,
    )),
    $html->element("div", array("class" => "panel-footer"), array(
        $html->element("div", array("class" => "row"), array(
            $html->element("div", array("class" => "col-sm-12 text-right"), array(
                $paginator->show($tot->num_rows, $var->get->page),
            )),
        )),
    )),
), true);
$html->element("div", array("class" => "modal fade", "id" => "more_info", "tabindex" => "-1", "role" => "dialog", "aria-hidden" => "true"), array(
    $html->element("div", array("class" => "modal-dialog"), array(
        $html->element("div", array("class" => "modal-content"), array(
            $html->element("div", array("class" => "modal-header"), array(
                $html->element("button", array("type" => "button", "class" => "close", "data-dismiss" => "modal"), array(
                    $html->element("span", array("aria-hidden" => "true"), array("&times;")),
                    $html->element("span", array("class" => "sr-only"), array("Close")),
                )),
                $html->element("h4", array("class" => "modal-title"), array("More Info")),
            )),
            $html->element("div", array("class" => "modal-body no-padding"), false),
            $html->element("div", array("class" => "modal-footer"), array(
                $html->element("button", array("type" => "button", "class" => "btn btn-primary", "data-dismiss" => "modal"), array(
                    "Close",
                )),
            )),
        )),
    )),
), true);
$html->Script('
    $(".more_info").click(function(){
        var data = decodeURIComponent($(this).data("info"));
        var modal = $("#more_info");
        modal.find(".modal-body").empty();
        modal.find(".modal-body").append("<table><tbody></tbody></table>");
        modal.find(".modal-body").find("table").addClass("table table-striped no-margins top-table");
        $.each($.parseJSON(data), function(k , v) {
            modal.find(".modal-body").find("tbody").append("<tr><td>"+k.toUpperCase()+"</td><td>"+v+"</td></tr>");
        });
        modal.modal("show");
    });
');
require_once ADMINPATH . '/footer.php';
