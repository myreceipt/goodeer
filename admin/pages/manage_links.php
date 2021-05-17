<?php
if (!defined("JUICYCODES")) {
    exit;
}
use IT\Data;
use IT\Tools;

$html->active("manage_links")->SetTitle("Manage Links");
require_once ADMINPATH . '/header.php';
if (!empty($var->get->jc_q)) {
    $search = "WHERE title LIKE '%{$var->get->jc_q}%' OR slug='{$var->get->jc_q}'";
}
if (!empty($var->get->id)) {
    $search = "WHERE user='{$var->get->id}'";
}
$files = $db->query("SELECT * FROM files $search ORDER BY date DESC LIMIT {$paginator->start},{$paginator->limit}");
$total = $db->query("SELECT * FROM files $search");
if ($files->num_rows < 1) {
    $files_table = $html->alert("No result found!", "default no-margins no-radius", "center");
} else {
    $i = 1;
    while ($file = $files->fetch_object()) {
        $links[] = $html->element("tr", false, array(
            $html->element("td", false, array($i++)),
            $html->element("td", false, array($html->highlight(Tools::Truncate($file->title, 30), $var->get->jc_q))),
            $html->element("td", false, array($var->date("d M, Y h:i A", $file->date))),
            $html->element("td", false, array(
                $html->element("span", array("class" => "badge"), array(
                    Tools::Source($file->source),
                )),
            )),
            $html->element("td", false, array(
                $html->element("a", array("href" => "#!", "class" => "btn btn-primary btn-xs get_embed", "data-slug" => $file->slug), array(
                    $html->element("i", array("class" => "fa fa-code")),
                    " Get Code",
                )),
            )),
            $html->element("td", false, array(
                $html->element("div", array("class" => "btn-group"), array(
                    $html->element("button", array("class" => "btn btn-primary btn-xs dropdown-toggle", "data-toggle" => "dropdown"), array(
                        "Get Links ",
                        $html->element("span", array("class" => "caret")),
                    )),
                    $html->element("ul", array("class" => "dropdown-menu"), array(
                        $html->element("li", false, array(
                            $html->element("a", array("href" => $html->Url("link/visit/{$file->id}")), array(Tools::Source($file->source), " Link")),
                        )),
                        $html->element("li", false, array(
                            $html->element("a", array("href" => Data::Get("url") . '/' . Data::Get("embed_slug") . '/' . $file->slug . '/'), array(
                                "Player Link",
                            )),
                        ), false, array(
                            array($file->type, "!=", "2"),
                        )),
                        $html->element("li", false, array(
                            $html->element("a", array("href" => Data::Get("url") . '/' . Data::Get("download_slug") . '/' . $file->slug . '/'), array(
                                "Download Link",
                            )),
                        ), false, array(
                            array($file->type, "!=", "1"),
                        )),
                    )),
                )),
            )),
            $html->element("td", false, array(
                $html->element("span", array("class" => "badge"), array(
                    number_format($file->views),
                )),
            )),
            $html->element("td", false, array(
                $html->element("a", array("href" => $html->Url("links/user/{$file->user}")), array(
                    $user->Info("name", $file->user),
                )),
            )),
            $html->element("td", false, array(
                $html->action($html->url("link/edit/{$file->id}"), "info", "fa fa-pencil", "EDIT"),
                $html->action($html->url("link/delete/{$file->id}"), "danger", "fa fa-trash", "DELETE", true),
            )),
        ));
    }
    $files_table = $html->element("div", array("class" => "table-responsive"), array(
        $html->element("table", array("class" => "table table-striped no-margins"), array(
            $html->element("thead", false, array(
                $html->element("tr", false, array(
                    $html->element("th", array("width" => "10px"), array("#")),
                    $html->element("th", false, array("Title")),
                    $html->element("th", array("width" => "170px"), array("Added On")),
                    $html->element("th", false, array("Video Source")),
                    $html->element("th", false, array("Embed Code")),
                    $html->element("th", false, array("Links")),
                    $html->element("th", false, array("Views")),
                    $html->element("th", false, array("User")),
                    $html->element("th", array("width" => "180px"), array("Actions")),
                )),
            )),
            $html->element("tbody", false, $links),
        )),
    ));
}
$html->element("div", array("class" => "panel"), array(
    $html->element("div", array("class" => "panel-heading"), array(
        $html->element("h3", array("class" => "panel-title"), array("MANAGE LINKS")),
        $html->element("div", array("class" => "right"), array(
            $html->element("a", array("class" => "btn btn-primary btn-sm", "href" => $html->url("add/link")), array("Add Link")),
        )),
    )),
    $html->element("div", array("class" => "panel-body no-padding"), array(
        $files_table,
    )),
    $html->element("div", array("class" => "panel-footer"), array(
        $html->element("div", array("class" => "row"), array(
            $html->element("div", array("class" => "col-md-3"), array(
                $html->element("form", array("method" => "get", "action" => $html->url("manage/links")), array(
                    $html->element("div", array("class" => "input-group"), array(
                        $html->input("text", "form-control input-sm", "jc_q", "jc_q", $var->get->jc_q, "Search Links By Title OR Slug..."),
                        $html->element("span", array("class" => "input-group-btn"), array(
                            $html->element("button", array("type" => "submit", "class" => "btn btn-info btn-sm"), array("Search")),
                        )),
                    )),
                )),
            )),
            $html->element("div", array("class" => "col-md-9 text-right"), array(
                $paginator->show($total->num_rows, $var->get->page),
            )),
        )),
    )),
), true);
list($iw, $ih) = array(Data::Get("width"), Data::Get("height"));
$html->element("div", array("class" => "modal fade", "id" => "embed_modal", "tabindex" => "-1", "role" => "dialog", "aria-hidden" => "true"), array(
    $html->element("div", array("class" => "modal-dialog"), array(
        $html->element("div", array("class" => "modal-content"), array(
            $html->element("div", array("class" => "modal-header"), array(
                $html->element("button", array("type" => "button", "class" => "close", "data-dismiss" => "modal"), array(
                    $html->element("span", array("aria-hidden" => "true"), array("&times;")),
                    $html->element("span", array("class" => "sr-only"), array("Close")),
                )),
                $html->element("h4", array("class" => "modal-title"), array("Get Embed Code")),
            )),
            $html->element("div", array("class" => "modal-body p-xs"), array(
                $html->element("textarea", array("class" => "form-control", "id" => "embed_code", "rows" => "6")),
                $html->element("textarea", array("class" => "hide", "id" => "embed_default", "rows" => "6"), array(
                    $html->element("iframe", array("width" => $iw, "height" => $ih, "src" => "URL", "frameborder" => "0", "allowfullscreen" => "true")),
                )),
            )),
            $html->element("div", array("class" => "modal-footer"), array(
                $html->element("button", array("type" => "button", "class" => "btn btn-primary", "data-dismiss" => "modal"), array(
                    "Close",
                )),
            )),
        )),
    )),
), true);
$html->Script("
    $('.get_embed').click(function(){
        var default_iframe=$('#embed_default').val();
        $('#embed_code').val(default_iframe.replace('URL','" . Data::Get("url") . "/" . Data::Get("embed_slug") . "/'+$(this).data('slug')+'/'));
        $('#embed_modal').modal('show');
    });
    $('.table-responsive').on('show.bs.dropdown', function () {
        $('.table-responsive').css( 'overflow', 'inherit' );
    });
    $('.table-responsive').on('hide.bs.dropdown', function () {
        $('.table-responsive').css( 'overflow', 'auto');
    });
");
require_once ADMINPATH . '/footer.php';
