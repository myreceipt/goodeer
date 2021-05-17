<?php
if (!defined("JUICYCODES")) {
    exit;
}
use IT\Data;
if ($user->Info("role") != "1") {
    $html->error("Access denied - You are not authorized to access this page!")->Redirect($html->Url(""), true);
}
$html->active("manage_settings")->SetTitle("Firewall Settings");
$html->AddStylesheet($var->url . '/assets/css/plugins/chosen.min.css')
    ->AddJavascript($var->url . '/assets/js/plugins/chosen.jquery.min.js');
require_once ADMINPATH . '/header.php';
$options   = array();
$countries = json_decode(file_get_contents(ABSPATH . "/framework/Plugins/country.json"));
foreach ($countries as $country) {
    $options[] = $html->option($country->name, $country->code, Data::Get("blocked_countries"), true);
}
$html->element("div", array("class" => "panel"), array(
    $html->element("div", array("class" => "panel-heading"), array(
        $html->element("h3", array("class" => "panel-title"), array("FIREWALL SETTINGS")),
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
                        $html->label("accs_restriction", "control-label", "Access Restriction"),
                        $html->tip("Disable access from all website except the allowed ones"),
                        $html->element("select", array("class" => "form-control", "id" => "accs_restriction", "name" => "accs_restriction"), array(
                            $html->option("Enable", "enable", Data::Get("accs_restriction")),
                            $html->option("Disable", "disable", Data::Get("accs_restriction")),
                        )),
                    )),
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("allowed_domains", "control-label", "Allowed Domains"),
                        $html->tip("Which website can access video player & downloader page. (,) Separated"),
                        $html->element("textarea", array("class" => "form-control", "id" => "allowed_domains", "name" => "allowed_domains", "rows" => "5"), array(
                            Data::Get("allowed_domains"),
                        )),
                    )),
                )),
                $html->element("div", array("class" => "col-lg-4 col-md-6"), array(
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("blocked_countries", "control-label", "Block Countries"),
                        $html->tip("Select Countries that you wish to block from accessing Player/Download"),
                        $html->element("select", array(
                            "class" => "form-control chosen-select",
                            "id"    => "blocked_countries",
                            "name"  => "blocked_countries[]", "multiple" => "multiple", "data-placeholder" => "Chose one or more country.You can search.",
                        ), $options),
                    )),
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("blocked_ips", "control-label", "Block Single IP/Subnet"),
                        $html->tip("Enter Single IPs/Subnets seperated by new line that you wish to block from accessing Player/Download"),
                        $html->element("textarea", array("class" => "form-control", "id" => "blocked_ips", "name" => "blocked_ips", "rows" => "5"), array(
                            Data::Get("blocked_ips"),
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
    $("#blocked_countries").chosen({no_results_text: "Oops, nothing found!"});
    $("#accs_restriction").bind("change",function(){
        $value = $(this).val();
        if ($value == "enable") {
            $("#allowed_domains").prop("disabled", false);
        } else {
            $("#allowed_domains").prop("disabled", true);
        }
    });
    $("#accs_restriction").trigger("change");
');
require_once ADMINPATH . '/footer.php';
