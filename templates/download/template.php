<?php
if (!defined("JUICYCODES")) {
    exit;
}
use IT\JuicyCodes;

function template_header($preview = false)
{
    $components = array(
        "html"        => '<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700">',
        "stylesheets" => array("style.css"),
        "javascripts" => array("juicycodes.js"),
    );
    return $components;
}

function template_body($source = array(), $subtitle = false, $preview = false, $slug, $dl = false)
{
    global $video;
    $dl_links = array();
    foreach ($source as $i => $link) {
        if ($link->label != "NA") {
            $dl_links[] = '<a href="' . JuicyCodes::Protect($link->file) . '">DOWNLOAD <span>' . $link->label . '</span></a>';
        }
    }
    $html = '
        <div id="wrapper">
            <div class="vertical-align-wrap">
                <div class="vertical-align-middle">
                    <div class="content">
                        <div class="content-box">
                            <div class="header">
                                <div class="title">DOWNLOAD VIDEO</div>
                            </div>
    ';
    if (empty($dl_links)) {
        $html .= '
        <center>
            <div class="error_message">
                No download link is found for this video.
            </div>
        </center>
        ';
    } else {
        $html .= '<div class="download_links">' . implode("<br/>", $dl_links) . '</div>';
    }
    $html .= '
                        </div>
                    </div>
                </div>
            </div>
        </div>
    ';
    return $html;
}

function template_footer($pop_ad = false, $pop_ad_code = false, $banner_ad = false, $banner_ad_code = false)
{
    $html = null;
    if ($banner_ad) {
        $html .= '
            <div class="banner" id="banner">
                <span class="close" onclick="return JuicyCodes.Close(); ">X</span>
                ' . $banner_ad_code . '
            </div>
        ';
    }
    if ($pop_ad) {
        $html .= $pop_ad_code;
    }
    if (JuicyCodes::GetError()) {
        $html .= '<script>JuicyCodes.Log("' . JuicyCodes::GetError() . '");</script>';
    }
    return $html;
}
