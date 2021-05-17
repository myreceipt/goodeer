<?php
if (!defined("JUICYCODES")) {
    exit;
}
use IT\JuicyCodes;
$html->active("manage_links")->SetTitle("Edit Links");
require_once ADMINPATH . '/header.php';
$links = $db->select("files", "*", array("id" => $var->get->id));
if ($links->num_rows != "1") {
    $html->error("Invalid Link Selected!")->Redirect($html->Url("manage/links"), true);
}
$link     = $links->fetch_object();
$subtitle = decode($link->subtitle, "stfu_ovi");
if (JuicyCodes::isSubtitle($subtitle)) {
    $subtitles = explode(",", $subtitle);
    foreach ($subtitles as $subtitle) {
        $sub_av = true;
        $sub[]  = '<span class="label label-success sub" data-sub="' . $subtitle . '">' . $subtitle . ' <i class="fa fa-times"></i></span>';
    }
}

$html->element("div", array("class" => "panel"), array(
    $html->element("div", array("class" => "panel-heading"), array(
        $html->element("h3", array("class" => "panel-title"), array("EDIT LINK")),
        $html->element("div", array("class" => "right"), array(
            $html->element("a", array("class" => "btn btn-primary btn-sm", "href" => $html->url("manage/links")), array("Manage Links")),
        )),
    )),
    $html->element("form", array("method" => "post", "action" => $html->url("actions"), "enctype" => "multipart/form-data"), array(
        $html->input("hidden", "hide", false, "action", "edit_link"),
        $html->input("hidden", "hide", false, "id", $var->get->id),
        $html->element("div", array("class" => "panel-body"), array(
            $html->element("div", array("class" => "row"), array(
                $html->element("div", array("class" => "col-lg-4 col-md-6"), array(
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("jc_title", "control-label", "Link Title"),
                        $html->tip("Insert Title For This Video"),
                        $html->input("text", "form-control", "jc_title", "jc_title", $link->title, "Insert Title For This Video"),
                    )),
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("jc_link", "control-label", "Video Link"),
                        $html->tip("Insert Link For This Video"),
                        $html->input("url", "form-control", "jc_link", "jc_link", JuicyCodes::Link(decode($link->link, "stfu_ovi"), $link->source)),
                    )),
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("jc_embed", "control-label", "Alt Embed Link"),
                        $html->tip("IInsert An Alternate Embed Link For This Video"),
                        $html->input("url", "form-control", "jc_embed", "jc_embed", $link->embed, "Insert An Alternate Embed Link For This Video"),
                    )),
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("jc_preview", "control-label", "Custom Preview"),
                        $html->tip("Insert Custom Preview URL For This Video"),
                        $html->element("span", array("class" => "pull-right"), array(
                            $html->element("span", array("class" => "label label-info cp", "id" => "pre"), array(
                                $html->element("i", array("class" => "fa fa-cloud-upload")),
                            )),
                        )),
                        $html->input("url", "form-control", "jc_preview", "jc_preview", decode($link->preview, "stfu_ovi"), "Insert Custom Preview URL"),
                    )),
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("remove_sub", "control-label", "Existing Subtitles"),
                        $html->tip("Existing Subtitles"),
                        $html->input("hidden", "hide", "remove_sub", "remove_sub"),
                        $html->element("div", array("class" => "subtitle"), array(implode(" ", $sub))),
                    ), false, array(
                        array(JuicyCodes::isSubtitle($subtitle)),
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
                        $html->input("text", "form-control", "jc_slug", "jc_slug", $link->slug),
                    )),
                )),
                $html->element("div", array("class" => "col-lg-2 col-md-3"), array(
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("jc_type", "control-label", "Generation Type"),
                        $html->tip("Insert Title For This Video"),
                        $html->element("select", array("class" => "form-control", "id" => "jc_type", "name" => "jc_type"), array(
                            $html->option("Player + Download", "3", $link->type),
                            $html->option("Only Player", "1", $link->type),
                            $html->option("Only Download", "2", $link->type),
                        )),
                    )),
                )),
            )),
        )),
        $html->element("div", array("class" => "panel-footer"), array(
            $html->element("button", array("type" => "submit", "class" => "btn btn-info"), array("EDIT LINK")),
        )),
    )),
), true);
$html->script('
    $("#pre").click(function(){
        var icon = $(this).find("i");
        $("#jc_preview").fadeOut("fast");
        if(icon.hasClass("fa-cloud-upload")){
            $(this).fadeOut("fast",function(){
                icon.removeClass("fa-cloud-upload").addClass("fa-chain");
                $("#jc_preview").prop("type","file").fadeIn("fast");
                $(this).fadeIn("fast");
            });
        } else{
            $(this).fadeOut("fast",function(){
                icon.removeClass("fa-chain").addClass("fa-cloud-upload");
                $("#jc_preview").prop("type","url").fadeIn("fast");
                $(this).fadeIn("fast");
            });
        }
    });
    $("#add_sub").click(function(){
        $($(".sub_file").eq(0).clone().val("")).appendTo($("#sub_files")).slideDown("fast");
        $($(".sub_label").eq(0).clone().val("")).appendTo($("#sub_labels")).slideDown("fast");
    });
    $(".sub i").click(function(){
        $(this).parent().fadeOut();
        var val=$("#remove_sub").val();
        $("#remove_sub").val(val+","+$(this).parent().data("sub"));
    });
');
require_once ADMINPATH . '/footer.php';

/**
 * Decode Given Encoded String
 * @param  string $data
 * @param  string $secret_key_ovi
 * @return string
 */
function decode($data, $secret_key_ovi)
{
    if ($secret_key_ovi != "stfu_ovi") {
        return "SORRY! BUT IT'S FUCKED UP!";
    }
    if (empty($data)) {
        return $data;
    }
    $password = 'EBuLTKjdCf0dmX7MQ1SrquKtvs7Fn5EW13xouUNGWwpqLWisMqe8v574HWS1UT2bkAMXC163euCz5MDm0U2GpuY';
    $data     = base64_decode(str_replace(array("-", "_"), array("+", "/"), $data));
    $salt     = substr($data, 10, 8);
    $ct       = substr($data, 18);

    $key = md5($password . $salt, true);
    $iv  = md5($key . $password . $salt, true);

    $pt = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $ct, MCRYPT_MODE_CBC, $iv);

    return trim($pt);
}
