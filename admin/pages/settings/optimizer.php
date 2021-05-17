<?php
if (!defined("JUICYCODES")) {
    exit;
}
use IT\Data;
if ($user->Info("role") != "1") {
    $html->error("Access denied - You are not authorized to access this page!")->Redirect($html->Url(""), true);
}
$html->active("manage_settings")->SetTitle("Optimizer Settings");
$html->AddStylesheet($var->url . '/assets/css/plugins/chosen.min.css')
    ->AddJavascript($var->url . '/assets/js/plugins/chosen.jquery.min.js');
require_once ADMINPATH . '/header.php';
$html->element("div", array("class" => "panel"), array(
    $html->element("div", array("class" => "panel-heading"), array(
        $html->element("h3", array("class" => "panel-title"), array("OPTIMIZER SETTINGS")),
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
                        $html->label("caching", "control-label", "Video Data Caching"),
                        $html->tip("Whether the video data will be cached or not"),
                        $html->element("select", array("class" => "form-control", "id" => "caching", "name" => "caching"), array(
                            $html->option("Enable", "on", Data::Get("caching")),
                            $html->option("Disable", "off", Data::Get("caching")),
                        )),
                    )),
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("allowed_qualities", "control-label", "Allowed Qualities"),
                        $html->tip("Allowed video qualities for streaming & downloading"),
                        $html->element("select", array("class" => "form-control", "id" => "allowed_qualities", "name" => "allowed_qualities[]", "multiple" => "multiple"), array(
                            $html->option("1080P", "1080p", Data::Get("allowed_qualities"), true),
                            $html->option("720P", "720p", Data::Get("allowed_qualities"), true),
                            $html->option("480P", "480p", Data::Get("allowed_qualities"), true),
                            $html->option("360P", "360p", Data::Get("allowed_qualities"), true),
                        )),
                    )),
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("minify_html", "control-label", "HTML Minification"),
                        $html->tip("Whether to minify page source for faster page load"),
                        $html->element("select", array("class" => "form-control", "id" => "minify_html", "name" => "minify_html"), array(
                            $html->option("Enable", "enable", Data::Get("minify_html")),
                            $html->option("Disable", "disable", Data::Get("minify_html")),
                        )),
                    )),
                )),
                $html->element("div", array("class" => "col-lg-3 col-md-4"), array(
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("cache_expire", "control-label", "Caching Expiry"),
                        $html->tip("How long (In Hour) will video play from cache before they expire?"),
                        $html->input("text", "form-control", "cache_expire", "cache_expire", Data::Get("cache_expire")),
                    )),
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("quality_order", "control-label", "Quality Order"),
                        $html->tip("In which order quality will be listed for streaming & downloading"),
                        $html->element("select", array("class" => "form-control", "id" => "quality_order", "name" => "quality_order"), array(
                            $html->option("ASC", "asc", Data::Get("quality_order")),
                            $html->option("DESC", "desc", Data::Get("quality_order")),
                        )),
                    )),
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("encrypt_js", "control-label", "JS Encryption"),
                        $html->tip("Whether to encrypt js for source protection"),
                        $html->element("select", array("class" => "form-control", "id" => "encrypt_js", "name" => "encrypt_js"), array(
                            $html->option("Enable", "enable", Data::Get("encrypt_js")),
                            $html->option("Disable", "disable", Data::Get("encrypt_js")),
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
$html->script('
    $("#allowed_qualities").chosen();
    $("#caching").bind("change",function(){
        $value = $(this).val();
        if ($value == "on") {
            $("#cache_expire").prop("disabled", false);
        } else {
            $("#cache_expire").prop("disabled", true);
        }
    });
    $("#caching").trigger("change");
');
require_once ADMINPATH . '/footer.php';
