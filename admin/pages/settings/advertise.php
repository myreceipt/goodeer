<?php
if (!defined("JUICYCODES")) {
    exit;
}
use IT\Data;
if ($user->Info("role") != "1") {
    $html->error("Access denied - You are not authorized to access this page!")->Redirect($html->Url(""), true);
}
$html->active("manage_settings")->SetTitle("Advertise Settings");
require_once ADMINPATH . '/header.php';
$html->element("div", array("class" => "panel"), array(
    $html->element("div", array("class" => "panel-heading"), array(
        $html->element("h3", array("class" => "panel-title"), array("ADVERTISE SETTINGS")),
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
                $html->element("div", array("class" => "col-lg-4 col-md-6"), array(
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("pop_ad_opt", "control-label", "Popup AD"),
                        $html->tip("Whether to show the popup ad code in streaimg & download page"),
                        $html->element("select", array("class" => "form-control", "id" => "pop_ad_opt", "name" => "pop_ad"), array(
                            $html->option("Enable", "enable", Data::Get("pop_ad")),
                            $html->option("Disable", "disable", Data::Get("pop_ad")),
                        )),
                    )),
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("pop_ad_code", "control-label", "Popup AD Code"),
                        $html->tip("Popup ad code to show  in streaimg & download page"),
                        $html->element("textarea", array("class" => "form-control", "id" => "pop_ad_code", "name" => "pop_ad_code", "rows" => "6"), array(
                            base64_decode(Data::Get("pop_ad_code")),
                        )),
                    )),
                )),
                $html->element("div", array("class" => "col-lg-4 col-md-6"), array(
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("banner_ad_opt", "control-label", "Banner AD"),
                        $html->tip("Whether to show the banner ad code in streaimg page"),
                        $html->element("select", array("class" => "form-control", "id" => "banner_ad_opt", "name" => "banner_ad"), array(
                            $html->option("Enable", "enable", Data::Get("banner_ad")),
                            $html->option("Disable", "disable", Data::Get("banner_ad")),
                        )),
                    )),
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("banner_ad_code", "control-label", "Banner AD Code"),
                        $html->tip("Banner ad code to show  in streaimg page"),
                        $html->element("textarea", array("class" => "form-control", "id" => "banner_ad_code", "name" => "banner_ad_code", "rows" => "6"), array(
                            base64_decode(Data::Get("banner_ad_code")),
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
    $("#pop_ad_opt").bind("change",function(){
        $value = $(this).val();
        if ($value == "enable") {
            $("#pop_ad_code").prop("disabled", false);
        } else {
            $("#pop_ad_code").prop("disabled", true);
        }
    });
    $("#banner_ad_opt").bind("change",function(){
        $value = $(this).val();
        if ($value == "enable") {
            $("#banner_ad_code").prop("disabled", false);
        } else {
            $("#banner_ad_code").prop("disabled", true);
        }
    });
    $("#pop_ad_opt").trigger("change");
    $("#banner_ad_opt").trigger("change");
');
require_once ADMINPATH . '/footer.php';
