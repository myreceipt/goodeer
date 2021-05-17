<?php
if (!defined("JUICYCODES")) {
    exit;
}
use IT\Data;
if ($user->Info("role") != "1") {
    $html->error("Access denied - You are not authorized to access this page!")->Redirect($html->Url(""), true);
}
$html->active("manage_settings")->SetTitle("General Settings");
require_once ADMINPATH . '/header.php';
$html->element("div", array("class" => "panel"), array(
    $html->element("div", array("class" => "panel-heading"), array(
        $html->element("h3", array("class" => "panel-title"), array("GENERAL SETTINGS")),
        $html->element("div", array("class" => "right"), array(
            $html->element("button", array("type" => "button", "class" => "btn-toggle-collapse"), array(
                $html->element("i", array("class" => "lnr lnr-chevron-up")),
            )),
        )),
    )),
    $html->element("form", array("method" => "post", "action" => $html->Url("actions"), "enctype" => "multipart/form-data"), array(
        $html->input("hidden", "hide", false, "action", "save_settings"),
        $html->element("div", array("class" => "panel-body"), array(
            $html->element("div", array("class" => "row"), array(
                $html->element("div", array("class" => "col-lg-4 col-md-6"), array(
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("license", "control-label", "Licensce Key"),
                        $html->tip("Licensce Key That You Recived From JuicyCodes.Com"),
                        $html->input("text", "form-control", "license", "license", Data::Get("license")),
                    )),
                    $html->element("div", array("class" => "row"), array(
                        $html->element("div", array("class" => "col-md-6"), array(
                            $html->element("div", array("class" => "form-group"), array(
                                $html->label("embed_slug", "control-label", "Embed Slug"),
                                $html->tip("Slug For Video Embeds Page﻿"),
                                $html->input("text", "form-control", "embed_slug", "embed_slug", Data::Get("embed_slug")),
                            )),
                            $html->element("div", array("class" => "form-group"), array(
                                $html->label("chunk_size", "control-label", "Chunk Size (MB)"),
                                $html->tip("Video Chunk Size In Megabyte"),
                                $html->input("text", "form-control", "chunk_size", "chunk_size", Data::Get("chunk_size")),
                            )),
                        )),
                        $html->element("div", array("class" => "col-md-6"), array(
                            $html->element("div", array("class" => "form-group"), array(
                                $html->label("download_slug", "control-label", "Download Slug"),
                                $html->tip("Slug For Video Download Page"),
                                $html->input("text", "form-control", "download_slug", "download_slug", Data::Get("download_slug")),
                            )),
                            $html->element("div", array("class" => "form-group"), array(
                                $html->label("rely", "control-label", "Rely On"),
                                $html->tip("Which method will be used to hsow player"),
                                $html->element("select", array("class" => "form-control", "id" => "rely", "name" => "rely"), array(
                                    $html->option("Core System", "core", Data::Get("rely")),
                                    $html->option("Alternate Embed LInk", "embed", Data::Get("rely")),
                                )),
                            )),
                        )),
                    )),
                )),
                $html->element("div", array("class" => "col-lg-4 col-md-6"), array(
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("url", "control-label", "Website URL"),
                        $html->tip("Your Website URL"),
                        $html->input("text", "form-control", "url", "url", Data::Get("url"), "Your Website URL"),
                    )),
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("logo", "control-label", "Website Logo"),
                        $html->tip("Your Website Logo URL/File"),
                        $html->element("span", array("class" => "pull-right"), array(
                            $html->element("span", array("class" => "label label-info cp", "id" => "pre"), array(
                                $html->element("i", array("class" => "fa fa-cloud-upload")),
                            )),
                        )),
                        $html->input("url", "form-control", "logo", "logo", Data::Get("logo")),
                    )),
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("default_title", "control-label", "Website Title"),
                        $html->tip("Used In Embed & Download Page If Video Title Is Empty"),
                        $html->input("text", "form-control", "default_title", "default_title", Data::Get("default_title")),
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
    $("#pre").click(function(){
        var icon = $(this).find("i");
        $("#logo").fadeOut("fast");
        if(icon.hasClass("fa-cloud-upload")){
            $(this).fadeOut("fast",function(){
                icon.removeClass("fa-cloud-upload").addClass("fa-chain");
                $("#logo").prop("type","file").fadeIn("fast");
                $(this).fadeIn("fast");
            });
        } else{
            $(this).fadeOut("fast",function(){
                icon.removeClass("fa-chain").addClass("fa-cloud-upload");
                $("#logo").prop("type","url").fadeIn("fast");
                $(this).fadeIn("fast");
            });
        }
    });
    $("#rely").bind("change",function(){
        $value = $(this).val();
        if ($value == "core") {
            $("#download_slug").prop("disabled", false);
        } else {
            $("#download_slug").prop("disabled", true);
        }
    });
    $("#rely").trigger("change");
');
require_once ADMINPATH . '/footer.php';
