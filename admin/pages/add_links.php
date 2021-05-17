<?php
if (!defined("JUICYCODES")) {
    exit;
}
use IT\Data;
$html->active("add_links")->SetTitle("Add Bulk Links");
require_once ADMINPATH . '/header.php';
$html->element("div", array("class" => "panel"), array(
    $html->element("div", array("class" => "panel-heading"), array(
        $html->element("h3", array("class" => "panel-title"), array("ADD BULK LINKS")),
        $html->element("div", array("class" => "right"), array(
            $html->element("button", array("type" => "button", "class" => "btn-toggle-collapse"), array(
                $html->element("i", array("class" => "lnr lnr-chevron-up")),
            )),
        )),
    )),
    $html->element("form", array("method" => "post", "action" => $html->Url("actions")), array(
        $html->input("hidden", "hide", false, "action", "add_links"),
        $html->element("div", array("class" => "panel-body"), array(
            $html->element("div", array("class" => "row"), array(
                $html->element("div", array("class" => "col-lg-4 col-md-6"), array(
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("jc_links", "control-label", "Video Links"),
                        $html->tip("Inster Video Links"),
                        $html->element("textarea", array("class" => "form-control", "id" => "jc_links", "name" => "jc_links", "rows" => "10")),
                    )),
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("jc_type", "control-label", "Generation Type"),
                        $html->tip("Insert Title For These Videos"),
                        $html->element("select", array("class" => "form-control", "id" => "jc_type", "name" => "jc_type"), array(
                            $html->option("Player + Download", "3", $type),
                            $html->option("Only Player", "1", $type),
                            $html->option("Only Download", "2", $type),
                        )),
                    )),
                )),
            )),
        )),
        $html->element("div", array("class" => "panel-footer"), array(
            $html->element("button", array("type" => "submit", "class" => "btn btn-info"), array("ADD LINKS")),
        )),
    )),
), true);
if (!empty($var->session("links"))) {
    $link          = json_decode($var->session("links"));
    $player_links  = $download_links  = array();
    list($iw, $ih) = array(Data::Get("width"), Data::Get("height"));
    foreach ($link->slug as $key => $slug) {
        if ($link->type != "2") {
            $player_links[] = Data::Get("url") . '/' . Data::Get("embed_slug") . '/' . $slug . '/';
        }
        if ($link->type != "1") {
            $download_links[] = Data::Get("url") . '/' . Data::Get("download_slug") . '/' . $slug . '/';
        }
    }
    $html->element("div", array("class" => "panel"), array(
        $html->element("div", array("class" => "panel-heading"), array(
            $html->element("h3", array("class" => "panel-title"), array("GET LINKS & EMBED CODE")),
            $html->element("div", array("class" => "right"), array(
                $html->element("button", array("type" => "button", "class" => "btn-toggle-collapse"), array(
                    $html->element("i", array("class" => "lnr lnr-chevron-up")),
                )),
                $html->element("button", array("type" => "button", "class" => "btn-remove"), array(
                    $html->element("i", array("class" => "lnr lnr-cross")),
                )),
            )),
        )),
        $html->element("div", array("class" => "panel-body"), array(
            $html->element("div", array("class" => "row"), array(

                $html->element("div", array("class" => "col-lg-4 col-md-6"), array(
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("player_link", "control-label", "Embed Player Links"),
                        $html->element("textarea", array("class" => "form-control", "id" => "player_link", "name" => "player_link", "rows" => "5"), array(
                            implode("\r\n", $player_links),
                        )),
                    )),
                ), false, array(
                    array($link->type, "!=", "2"),
                )),
                $html->element("div", array("class" => "col-lg-4 col-md-6"), array(
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("download_link", "control-label", "Download Links"),
                        $html->element("textarea", array("class" => "form-control", "id" => "download_link", "name" => "download_link", "rows" => "5"), array(
                            implode("\r\n", $download_links),
                        )),
                    )),
                ), false, array(
                    array($link->type, "!=", "1"),
                )),
            )),
        )),
    ), true);
    $var->remove_session("links");
}
require_once ADMINPATH . '/footer.php';
