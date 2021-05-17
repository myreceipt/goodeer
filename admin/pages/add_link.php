<?php
if (!defined("JUICYCODES")) {
    exit;
}
use IT\Data;
$html->active("add_link")->SetTitle("Add Link");
require_once ADMINPATH . '/header.php';
$pre   = $var->cookie("jc_preview") ?: "url";
$ico   = ($pre == "file" ? "fa-chain" : "fa-cloud-upload");
$pre_c = ($pre == "file" ? "url" : "file");
$pre_i = ($pre == "file" ? "fa-cloud-upload" : "fa-chain");
$html->element("div", array("class" => "panel"), array(
    $html->element("div", array("class" => "panel-heading"), array(
        $html->element("h3", array("class" => "panel-title"), array("ADD NEW LINK")),
        $html->element("div", array("class" => "right"), array(
            $html->element("button", array("type" => "button", "class" => "btn-toggle-collapse"), array(
                $html->element("i", array("class" => "lnr lnr-chevron-up")),
            )),
        )),
    )),
    $html->element("form", array("method" => "post", "action" => $html->url("actions"), "enctype" => "multipart/form-data"), array(
        $html->input("hidden", "hide", false, "action", "add_link"),
        $html->element("div", array("class" => "panel-body"), array(
            $html->element("div", array("class" => "row"), array(
                $html->element("div", array("class" => "col-lg-4 col-md-6"), array(
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("jc_title", "control-label", "Link Title"),
                        $html->tip("Insert Title For This Video"),
                        $html->input("text", "form-control", "jc_title", "jc_title", "Insert Title For This Video", true),
                    )),
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("jc_link", "control-label", "Video Link"),
                        $html->tip("Insert Link For This Video"),
                        $html->input("url", "form-control", "jc_link", "jc_link", "Insert Link For This Video", true),
                    )),
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("jc_embed", "control-label", "Alt Embed Link"),
                        $html->tip("IInsert An Alternate Embed Link For This Video"),
                        $html->input("url", "form-control", "jc_embed", "jc_embed", "Insert An Alternate Embed Link For This Video", true),
                    )),
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("jc_preview", "control-label", "Custom Preview"),
                        $html->tip("Insert Custom Preview URL For This Video"),
                        $html->element("span", array("class" => "pull-right"), array(
                            $html->element("span", array("class" => "label label-info cp", "id" => "pre"), array(
                                $html->element("i", array("class" => "fa $ico")),
                            )),
                        )),
                        $html->input($pre, "form-control", "jc_preview", "jc_preview", "Insert Custom Preview URL", true),
                    )),
                )),
            )),
            $html->element("div", array("class" => "row"), array(
                $html->element("div", array("class" => "col-lg-2 col-md-3"), array(
                    $html->element("div", array("class" => "form-group", "id" => "sub_files"), array(
                        $html->label(false, "control-label", "Subtitle File"),
                        $html->tip("Select Subtitle File For This Video"),
                        $html->input("file", "form-control sub_file m-b-xs", false, "subtitle[]"),
                    )),
                )),
                $html->element("div", array("class" => "col-lg-2 col-md-3"), array(
                    $html->element("div", array("class" => "form-group", "id" => "sub_labels"), array(
                        $html->label(false, "control-label", "Subtitle Label"),
                        $html->tip("Insert Subtitle Language For This Video"),
                        $html->element("span", array("class" => "pull-right"), array(
                            $html->element("span", array("class" => "label label-info cp", "id" => "add_sub"), array(
                                $html->element("i", array("class" => "fa fa-plus")),
                            )),
                        )),
                        $html->input("text", "form-control sub_label m-b-xs", false, "subtitle_label[]"),
                    )),
                )),
            )),
            $html->element("div", array("class" => "row"), array(
                $html->element("div", array("class" => "col-lg-2 col-md-3"), array(
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("jc_slug", "control-label", "Custom Slug"),
                        $html->tip("Insert Custom Slug For This Video"),
                        $html->input("text", "form-control", "jc_slug", "jc_slug"),
                    )),
                )),
                $html->element("div", array("class" => "col-lg-2 col-md-3"), array(
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("jc_type", "control-label", "Generation Type"),
                        $html->tip("Insert Title For This Video"),
                        $html->element("select", array("class" => "form-control", "id" => "jc_type", "name" => "jc_type"), array(
                            $html->option("Player + Download", "3", $var->cookie("jc_type")),
                            $html->option("Only Player", "1", $var->cookie("jc_type")),
                            $html->option("Only Download", "2", $var->cookie("jc_type")),
                        )),
                    )),
                )),
            )),
        )),
        $html->element("div", array("class" => "panel-footer"), array(
            $html->element("button", array("type" => "submit", "class" => "btn btn-info"), array("ADD LINK")),
        )),
    )),
), true);
if (!empty($var->session("links"))) {
    $link          = json_decode($var->session("links"));
    list($iw, $ih) = array(Data::Get("width"), Data::Get("height"));
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
                        $html->label("embed_player_link", "control-label", "Embed Player Link"),
                        $html->input("text", "form-control", "embed_player_link", "embed_player_link",
                            Data::Get("url") . '/' . Data::Get("embed_slug") . '/' . $link->slug . '/'
                        ),
                    ), false, array(
                        array($link->type, "!=", "2"),
                    )),
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("download_link", "control-label", "Download Link"),
                        $html->input("text", "form-control", "download_link", "download_link",
                            Data::Get("url") . '/' . Data::Get("download_slug") . '/' . $link->slug . '/'
                        ),
                    ), false, array(
                        array($link->type, "!=", "1"),
                    )),
                )),
                $html->element("div", array("class" => "col-lg-4 col-md-6"), array(
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("iframe_code", "control-label", "Embed Player Link"),
                        $html->element("textarea", array("class" => "form-control", "id" => "iframe_code", "name" => "iframe_code", "rows" => "4"), array(
                            $html->element("iframe", array(
                                "width"           => $iw,
                                "height"          => $ih,
                                "src"             => Data::Get("url") . '/' . Data::Get("embed_slug") . '/' . $link->slug . '/',
                                "frameborder"     => "0",
                                "allowfullscreen" => "true",
                            )),
                        )),
                    )),
                ), false, array(
                    array($link->type, "!=", "2"),
                )),
            )),
        )),
    ), true);
    $var->remove_session("links");
}
$html->script('
    $("#pre").click(function(){
        var icon = $(this).find("i");
        $("#jc_preview").fadeOut("fast");
        if(icon.hasClass("' . $ico . '")){
            $(this).fadeOut("fast",function(){
                icon.removeClass("' . $ico . '").addClass("' . $pre_i . '");
                $("#jc_preview").prop("type","' . $pre_c . '").fadeIn("fast");
                $(this).fadeIn("fast");
            });
        } else{
            $(this).fadeOut("fast",function(){
                icon.removeClass("' . $pre_i . '").addClass("' . $ico . '");
                $("#jc_preview").prop("type","' . $pre . '").fadeIn("fast");
                $(this).fadeIn("fast");
            });
        }
    });
    $("#add_sub").click(function(){
        $($(".sub_file").eq(0).clone().val("")).appendTo($("#sub_files")).slideDown("fast");
        $($(".sub_label").eq(0).clone().val("")).appendTo($("#sub_labels")).slideDown("fast");
    });
');
require_once ADMINPATH . '/footer.php';
