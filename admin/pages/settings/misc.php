<?php
if (!defined("JUICYCODES")) {
    exit;
}
use IT\Data;
if ($user->Info("role") != "1") {
    $html->error("Access denied - You are not authorized to access this page!")->Redirect($html->Url(""), true);
}
$html->active("manage_settings")->SetTitle("Misc Settings");
require_once ADMINPATH . '/header.php';
foreach (timezone_identifiers_list() as $timezone) {
    $timezones[] = $html->option($timezone, $timezone, Data::Get("timezone"), true);
}
$html->element("div", array("class" => "panel"), array(
    $html->element("div", array("class" => "panel-heading"), array(
        $html->element("h3", array("class" => "panel-title"), array("MISC SETTINGS")),
        $html->element("div", array("class" => "right"), array(
            $html->element("button", array("type" => "button", "class" => "btn-toggle-collapse"), array(
                $html->element("i", array("class" => "lnr lnr-chevron-up")),
            )),
        )),
    )),
    $html->element("form", array("method" => "post", "action" => $html->Url("actions")), array(
        $html->input("hidden", "hide", false, "action", "save_settings"),
        $html->element("div", array("class" => "panel-body"), array(
            $html->element("div", array("class" => "row"), array(
                $html->element("div", array("class" => "col-lg-3 col-md-4"), array(
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("default_preview", "control-label", "Default Preview Link"),
                        $html->tip("The preview image when no preview is available for a video"),
                        $html->input("text", "form-control", "default_preview", "default_preview", Data::Get("default_preview"), "Enter Preview Link"),
                    )),
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("timezone", "control-label", "Default Time Zone"),
                        $html->tip("Sets the default timezone used by all date/time functions"),
                        $html->element("select", array("class" => "form-control", "id" => "timezone", "name" => "timezone"), $timezones),
                    )),
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("subtitle", "control-label", "Video Subtitle"),
                        $html->tip("Whether to show or hide video subtitle/cc"),
                        $html->element("select", array("class" => "form-control", "id" => "subtitle", "name" => "subtitle"), array(
                            $html->option("Enable", "on", Data::Get("subtitle")),
                            $html->option("Disable", "off", Data::Get("subtitle")),
                        )),
                    )),
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("auto_preview", "control-label", "Auto Preview Generation"),
                        $html->tip("Whether to generate automatic preview for a video"),
                        $html->element("select", array("class" => "form-control", "id" => "auto_preview", "name" => "auto_preview"), array(
                            $html->option("Enable", "enable", Data::Get("auto_preview")),
                            $html->option("Disable", "disable", Data::Get("auto_preview")),
                        )),
                    )),
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("embed_player", "control-label", "Embed Player"),
                        $html->tip("Whether to disable/hide embed player page"),
                        $html->element("select", array("class" => "form-control", "id" => "embed_player", "name" => "embed_player"), array(
                            $html->option("Enable", "enable", Data::Get("embed_player")),
                            $html->option("Disable", "disable", Data::Get("embed_player")),
                        )),
                    )),
                )),
                $html->element("div", array("class" => "col-lg-3 col-md-4"), array(
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("default_video", "control-label", "Default Video Link"),
                        $html->tip("The video when no playable source is available for a video"),
                        $html->input("text", "form-control", "default_video", "default_video", Data::Get("default_video")),
                    )),
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("page_limit", "control-label", "Items Per Page"),
                        $html->tip("How many items you want to show per page on admin panel"),
                        $html->input("text", "form-control", "page_limit", "page_limit", Data::Get("page_limit")),
                    )),
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("auto_cc", "control-label", "Auto Subtitle Display"),
                        $html->tip("Whether or not the first subtitles is automatically displayed on startup"),
                        $html->element("select", array("class" => "form-control", "id" => "auto_cc", "name" => "auto_cc"), array(
                            $html->option("Enable", "enable", Data::Get("auto_cc")),
                            $html->option("Disable", "disable", Data::Get("auto_cc")),
                        )),
                    )),
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("custom_preview", "control-label", "Custom Preview"),
                        $html->tip("Whether to show or hide manually added video preview"),
                        $html->element("select", array("class" => "form-control", "id" => "custom_preview", "name" => "custom_preview"), array(
                            $html->option("Show", "show", Data::Get("custom_preview")),
                            $html->option("Hide", "hide", Data::Get("custom_preview")),
                        )),
                    )),
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("file_download", "control-label", "File Download"),
                        $html->tip("Whether to disable/hide file downloader page"),
                        $html->element("select", array("class" => "form-control", "id" => "file_download", "name" => "file_download"), array(
                            $html->option("Enable", "enable", Data::Get("file_download")),
                            $html->option("Disable", "disable", Data::Get("file_download")),
                        )),
                    )),
                )),
            )),
        )),
        $html->element("div", array("class" => "panel-footer"), array(
            $html->element("button", array("type" => "submit", "class" => "btn btn-info"), array("SAVE SETTINGS")),
        )),
    )),
), true);
require_once ADMINPATH . '/footer.php';
