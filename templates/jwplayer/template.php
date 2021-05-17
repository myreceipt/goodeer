<?php
if (!defined("JUICYCODES")) {
    exit;
}

//echo '<script type="text/javascript" src="//content.jwplatform.com/libraries/0P4vdmeO.js"></script>';
use IT\Data;
use IT\JuicyCodes;

function template_header($preview = false)
{
    $components = array(
        //"html"        => '<script>jwplayer.key = "' . Data::Get("jwp_key") . '";</script>',
        "stylesheets" => array("juicycodes.css"),
        "javascripts" => array("//content.jwplatform.com/libraries/0P4vdmeO.js","juicycodes.js"),
    );
    return $components;
}

function template_body($source = array(), $subtitle = false, $preview = false, $slug, $dl = false)
{
    if (Data::Get("rely") == "embed" && is_string($source["0"])) {
        return '<div class="embed-container"><iframe src="' . $source["0"] . '" frameborder="0" allowfullscreen="allowfullscreen"></iframe></div>';
    }
    $html   = '<div id="video_player"></div>';
    $script = '
    var player = jwplayer("video_player");
    var config = {
        advertising: {
            client: "vast",
                schedule: {
                        adbreak1: {
                        offset : "pre",                         
                            tag: "https://ad.doubleclick.net/ddm/pfadx/N566201.3276967NONTONDRAMA.ID/B20674424.220559326;sz=0x0;ord=[timestamp];dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;dcmt=text/xml;dc_vast=2",
                        skipoffset: 5
                        },
                    adbreak2: {
                        offset: "50%",
                        tag: "https://ad.doubleclick.net/ddm/pfadx/N566201.3276967NONTONDRAMA.ID/B20674424.220559326;sz=0x0;ord=[timestamp];dc_lat=;dc_rdid=;tag_for_child_directed_treatment=;dcmt=text/xml;dc_vast=2",
                        skipoffset: 5
                        },
                },
            },  
        width: "' . Data::Get("width") . '",
        height: "' . Data::Get("height") . '",
        aspectratio: "' . Data::Get("aspect_ratio") . '",
        autostart: ' . Data::Get("autostart") . ',
        controls: ' . Data::Get("player_controls") . ',
        primary: "' . Data::Get("primary") . '",
        abouttext: "' . Data::Get("about_text") . '",
        aboutlink: "' . Data::Get("about_link") . '",
        image: "' . $preview . '",
        sources: ' . json_encode($source, JSON_UNESCAPED_SLASHES) . ',
        tracks: ' . json_encode($subtitle, JSON_UNESCAPED_SLASHES) . ',
        logo: {
            file: "' . Data::Get("logo") . '",
            link: "' . Data::Get("about_link") . '",
            position: "top-left",
        },
        captions: {
            color: "' . Data::Get("font_color") . '",
            fontSize: "' . Data::Get("font_size") . '",
            fontFamily: "' . Data::Get("font_family") . '",
            backgroundColor: "' . Data::Get("bg_color") . '",
        }
    };
    ';
    if (Data::Get("share_btn") == "on") {
        $script .= 'config.sharing = {sites: ["facebook","twitter","email","googleplus","reddit"]};';
    }
    $script .= "player.setup(config);";
    if ($dl) {
        $script .= '
        player.addButton(
            "' . Data::Get("url") . '/templates/jwplayer/assets/download.svg",
            "Download Video",
            function() {
                window.open("' . Data::Get("url") . '/' . Data::Get("download_slug") . '/' . $slug . '/","_blank");
            },
            "download"
        );
        ';
    }
    $html .= '<script type="text/javascript">' . JuicyCodes::Encrypt($script) . '</script>';
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
