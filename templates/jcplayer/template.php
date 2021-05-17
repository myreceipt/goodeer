<?php
if (!defined("JUICYCODES")) {
    exit;
}
use IT\Data;
use IT\JuicyCodes;

function template_header($preview = false)
{
    $components = array(
        "html"        => '<style id="text_track"></style>',
        "stylesheets" => array("jc-skin.css", "juicycodes.css"),
        "javascripts" => array("ie8.min.js", "jquery.min.js", "video.min.js", "plugin.js", "juicycodes.js"),
    );
    return $components;
}

function template_body($source = array(), $subtitle = false, $preview = false, $slug, $dl = false)
{
    if (Data::Get("rely") == "embed" && is_string($source["0"])) {
        return '<div class="embed-container"><iframe src="' . $source["0"] . '" frameborder="0" allowfullscreen="allowfullscreen"></iframe></div>';
    }
    $sources = array();
    foreach ($source as $key => $data) {
        $sources[] = array("src" => $data->file, "label" => $data->label, "type" => $data->type, "res" => str_replace("P", null, $data->label));
    }
    if ($subtitle) {
        foreach ($subtitle as $key => $sub) {
            $subtitles .= '<track kind="captions" src="' . $sub["file"] . '" label="' . $sub["label"] . '" default="' . $sub["default"] . '">';
        }
    }
    if (Data::Get("quality_order") == "asc") {
        $order = "low";
    } else {
        $order = "high";
    }
    $html = '
    <video id="video_player" class="video-js vjs-default-skin vjs-big-play-centered" playsInline>' . $subtitles . '</video>
    ';
    $script = '
    var config = {
        width: "' . Data::Get("width") . '",
        height: "' . Data::Get("height") . '",
        aspectRatio: "' . Data::Get("aspect_ratio") . '",
        autoplay: ' . Data::Get("autostart") . ',
        controls: ' . Data::Get("player_controls") . ',
        poster: "' . $preview . '",
        sources: ' . json_encode($sources, JSON_UNESCAPED_SLASHES) . '
    };
    var player = videojs("video_player",config);
    player.logo({
        file: "' . Data::Get("logo") . '",
        link: "' . Data::Get("about_link") . '",
    });
    player.captions({
        color: "' . Data::Get("font_color") . '",
        fontSize: "' . Data::Get("font_size") . '",
        fontFamily: "' . Data::Get("font_family") . '",
        backgroundColor: "' . Data::Get("bg_color") . '",
    });
    player.videoJsResolutionSwitcher({default: "' . $order . '"});
    ';
    if (Data::Get("share_btn") == "on") {
        $script .= 'player.share();';
    }
    if ($dl) {
        $script .= '
        player.button(
            "' . Data::Get("url") . '/templates/jwplayer/assets/download.svg",
            function() {
                window.open("' . Data::Get("url") . '/' . Data::Get("download_slug") . '/' . $slug . '/","_blank");
            },
            "dl_btn"
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
