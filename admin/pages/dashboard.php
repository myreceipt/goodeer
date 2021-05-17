<?php
if (!defined("JUICYCODES")) {
    exit;
}
use IT\App;
use IT\Data;
use IT\Tools;

$html->active("dashboard");
$html->AddStylesheet($var->url . '/assets/css/plugins/morris.css')
    ->AddJavascript(array(
        $var->url . '/assets/js/plugins/morris.min.js',
        $var->url . '/assets/js/plugins/raphael.min.js',
        $var->url . '/assets/js/dashboard.js',
    ));
require_once ADMINPATH . '/header.php';

$now          = $var->time();
$valid        = $db->query("SELECT uid FROM cache WHERE expiry > '$now'");
$expired      = $db->query("SELECT uid FROM cache WHERE expiry <= '$now'");
$statistics   = $db->query("SELECT * FROM `stats` WHERE date > DATE(NOW()) - INTERVAL 10 DAY ORDER BY date ASC");
$total_videos = $db->query("SELECT id FROM files");
if (empty($valid->num_rows) && empty($expired->num_rows)) {
    $c_c = "m-dis";
}
if (empty($statistics->num_rows)) {
    $v_c = "m-dis";
}
$files = $db->query("SELECT * FROM files ORDER BY views DESC LIMIT 0,5");
if ($files->num_rows < 1) {
    $videos[] = $html->alert("No result found!", "default no-margins no-radius", "center");
} else {
    $i = 1;
    while ($file = $files->fetch_object()) {
        if ($file->type != "2") {
            $file_link = Data::Get("url") . '/' . Data::Get("embed_slug") . '/' . $file->slug . '/';
        } else {
            $file_link = Data::Get("url") . '/' . Data::Get("download_slug") . '/' . $file->slug . '/';
        }
        $videos[] = $html->element("tr", false, array(
            $html->element("td", false, array(
                $i++,
                ". ",
                $html->element("a", array("href" => $file_link), array(
                    Tools::Truncate($file->title, 30),
                )),
            )),
            $html->element("td", false, array(
                $html->element("span", array("class" => "badge badge-success"), array(
                    number_format($file->views),
                )),
            )),
            $html->element("td", false, array(
                $html->element("a", array("class" => "btn btn-xs btn-info", "href" => $html->url("link/edit/{$file->id}")), array(
                    $html->element("i", array("class" => "fa fa-pencil"), false),
                    " EDIT",
                )),
            )),
        ));
    }
}
$html->element("div", array("class" => "row"), array(
    $html->element("div", array("class" => "col-sm-12"), array(
        $html->element("div", array("class" => "panel"), array(
            $html->element("div", array("class" => "panel-heading"), array(
                $html->element("h3", array("class" => "panel-title"), array("OVERVIEW")),
            )),
            $html->element("div", array("class" => "panel-body"), array(
                $html->element("div", array("class" => "row"), array(
                    $html->element("div", array("class" => "col-md-9"), array(
                        $html->element("div", array("id" => "stats-chart", "class" => "$v_c"), array(
                        )),
                    )),
                    $html->element("div", array("class" => "col-md-3"), array(
                        $html->element("div", array("class" => "weekly-summary text-right"), array(
                            $html->element("span", array("class" => "number"), array(number_format($total_videos->num_rows))),
                            $html->element("span", array("class" => "info-label"), array("Total Added Videos")),
                        )),
                        $html->element("div", array("class" => "weekly-summary text-right"), array(
                            $html->element("span", array("class" => "number", "id" => ""), array(
                                $html->element("div", array("class" => "wave"), array(
                                    $html->element("span", array("class" => "dot"), false),
                                    $html->element("span", array("class" => "dot"), false),
                                    $html->element("span", array("class" => "dot"), false),
                                )),
                            )),
                            $html->element("span", array("class" => "info-label"), array("")),
                        )),
                        $html->element("div", array("class" => "weekly-summary text-right truncate"), array(
                            $html->element("span", array("class" => "number", "id" => ""), array(
                                $html->element("div", array("class" => "wave"), array(
                                    $html->element("span", array("class" => "dot"), false),
                                    $html->element("span", array("class" => "dot"), false),
                                    $html->element("span", array("class" => "dot"), false),
                                )),
                            )),
                            $html->element("span", array("class" => "info-label"), array("")),
                        )),
                    )),
                )),
            )),
        )),
    )),
), true);
$html->element("div", array("class" => "row"), array(
    $html->element("div", array("class" => "col-md-4"), array(
        $html->element("div", array("class" => "panel"), array(
            $html->element("div", array("class" => "panel-heading"), array(
                $html->element("h3", array("class" => "panel-title"), array("POPULAR VIDEOS")),
            )),
            $html->element("div", array("class" => "panel-body no-padding"), array(
                $html->element("table", array("class" => "table table-striped no-margins top-table"), array(
                    $html->element("tbody", false, $videos),
                )),
            )),
        )),
    )),
    $html->element("div", array("class" => "col-md-4"), array(
        $html->element("div", array("class" => "panel"), array(
            $html->element("div", array("class" => "panel-heading"), array(
                $html->element("h3", array("class" => "panel-title"), array("MANAGE CACHE")),
                $html->element("div", array("class" => "right"), array(
                    (Data::Get("caching") == "on" ? $html->element("span", array("class" => "label label-success"), array("ACTIVE")) : null),
                    (Data::Get("caching") != "on" ? $html->element("span", array("class" => "label label-danger"), array("INACTIVE")) : null),
                )),
            )),
            $html->element("div", array("class" => "panel-body text-center no-padding"), array(
                $html->element("div", array("id" => "cache_chart", "class" => "d-chart {$c_c}"), false),
                $html->element("i", array("class" => "text-muted"), array("Total: ", ($valid->num_rows + $expired->num_rows))),
                $html->element("div", array("class" => "m-sm"), array(
                    $html->action($html->url("cache/clear/all"), "warning", "fa fa-bars", "CLEAR ALL", true),
                    " ",
                    $html->action($html->url("cache/clear/expired"), "warning", "fa fa-exclamation-triangle", "CLEAR EXPIRED", true),
                )),
            )),
        )),
    )),
    $html->element("div", array("class" => "col-md-4"), array(
        $html->element("div", array("class" => "panel"), array(
            $html->element("div", array("class" => "panel-heading"), array(
                $html->element("h3", array("class" => "panel-title"), array("SCRIPT INFO")),
            )),
            $html->element("div", array("class" => "panel-body no-padding"), array(
                $html->element("table", array("class" => "table table-striped no-margins top-table"), array(
                    $html->element("tbody", false, array(
                        $html->element("tr", false, array(
                            $html->element("td", false, array("Rp.500.000,-")),
                            $html->element("td", false, array(
                                $html->element("a", array(
                                    "href"  => "",
                                    "class" => "pull-right",
                                ), array(
                                    "Google Drive Proxy Player Script",
                                )),
                            )),
                        )),
                        $html->element("tr", false, array(
                            $html->element("td", false, array("UNLIMITED DOMAINS!")),
                            $html->element("td", false, array($html->element("span", array("class" => "pull-right"), array(Data::Get(""))))),
                        )),
                        $html->element("tr", false, array(
                            $html->element("td", false, array("Updates!")),
                            $html->element("td", false, array($html->element("span", array("class" => "badge pull-right"), array(
                                App::Version(),
                            )))),
                        )),
                        $html->element("tr", false, array(
                            $html->element("td", false, array("100% Nulled")),
                            $html->element("td", false, array(
                                $html->element("span", array("class" => "badge pull-right", "id" => ""), array(
                                    $html->element("div", array("class" => "wave"), array(
                                        $html->element("span", array("class" => "dot"), false),
                                        $html->element("span", array("class" => "dot"), false),
                                        $html->element("span", array("class" => "dot"), false),
                                    )),
                                )),
                            )),
                        )),
                        $html->element("tr", false, array(
                            $html->element("td", false, array("skype : live:danuhamtaro")),
                            $html->element("td", false, array(
                                $html->element("span", array("class" => "badge pull-right", "id" => ""), array(
                                    $html->element("div", array("class" => "wave"), array(
                                        $html->element("span", array("class" => "dot"), false),
                                        $html->element("span", array("class" => "dot"), false),
                                        $html->element("span", array("class" => "dot"), false),
                                    )),
                                )),
                            )),
                        )),
                    )),
                )),
            )),
        )),
    )),
), true);

while ($stats = $statistics->fetch_object()) {
    $views[] = array(
        "date"  => date("M d", strtotime($stats->date)),
        "views" => $stats->views,
    );
}
$html->script('
var cache_data = [{label: "Valid", value: ' . $valid->num_rows . '},{label: "Expired", value: ' . $expired->num_rows . '}];
var views_data = ' . json_encode($views) . ';
');
require_once ADMINPATH . '/footer.php';
