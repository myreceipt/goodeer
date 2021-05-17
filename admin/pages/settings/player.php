<?php
if (!defined("JUICYCODES")) {
    exit;
}
use IT\Data;
if ($user->Info("role") != "1") {
    $html->error("Access denied - You are not authorized to access this page!")->Redirect($html->Url(""), true);
}
$html->active("manage_settings")->SetTitle("Player Settings");
require_once ADMINPATH . '/header.php';
$html->element("div", array("class" => "panel"), array(
    $html->element("div", array("class" => "panel-heading"), array(
        $html->element("h3", array("class" => "panel-title"), array("PLAYER SETTINGS")),
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
                        $html->label("player", "control-label", "Video Player"),
                        $html->tip("Select A Video Player"),
                        $html->element("select", array("class" => "form-control", "id" => "player", "name" => "player"), array(
                            $html->option("JUICY Player", "jcplayer", Data::Get("player")),
                            $html->option("JW Player", "jwplayer", Data::Get("player")),
                            $html->option("VideoJS", "videojs", Data::Get("player")),
                        )),
                    )),
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("about_text", "control-label", "About Text"),
                        $html->tip("Custom text to display in the right-click menu of JW Player"),
                        $html->input("text", "form-control", "about_text", "about_text", Data::Get("about_text")),
                    )),
                    $html->element("div", array("class" => "row"), array(
                        $html->element("div", array("class" => "col-sm-6"), array(
                            $html->element("div", array("class" => "form-group"), array(
                                $html->label("width", "control-label", "Player Width"),
                                $html->tip("The desired width of your video player"),
                                $html->input("text", "form-control", "width", "width", Data::Get("width"), "Enter Player Width"),
                            )),
                        )),
                        $html->element("div", array("class" => "col-sm-6"), array(
                            $html->element("div", array("class" => "form-group"), array(
                                $html->label("height", "control-label", "Player Height"),
                                $html->tip("The desired height of your video player"),
                                $html->input("text", "form-control", "height", "height", Data::Get("height"), "Enter Player Height"),
                            )),
                        )),
                        $html->element("div", array("class" => "col-sm-6"), array(
                            $html->element("div", array("class" => "form-group"), array(
                                $html->label("aspect_ratio", "control-label", "Aspect Ratio"),
                                $html->tip("Enter Aspect Ratio In (x:y) Format"),
                                $html->input("text", "form-control", "aspect_ratio", "aspect_ratio", Data::Get("aspect_ratio"), "Enter Aspect Ratio"),

                            )),
                        )),
                        $html->element("div", array("class" => "col-sm-6"), array(
                            $html->element("div", array("class" => "form-group"), array(
                                $html->label("player_controls", "control-label", "Player Controls"),
                                $html->tip("Whether to display the video controls"),
                                $html->element("select", array("class" => "form-control", "id" => "player_controls", "name" => "player_controls"), array(
                                    $html->option("Visible", "true", Data::Get("player_controls")),
                                    $html->option("Hidden", "false", Data::Get("player_controls")),
                                )),
                            )),
                        )),
                        $html->element("div", array("class" => "col-sm-6"), array(
                            $html->element("div", array("class" => "form-group"), array(
                                $html->label("autostart", "control-label", "Video Autostart"),
                                $html->tip("Whether the player will attempt to begin playback automatically when a page is loaded"),
                                $html->element("select", array("class" => "form-control", "id" => "controls", "name" => "autostart"), array(
                                    $html->option("Enable", "true", Data::Get("autostart")),
                                    $html->option("Disable", "false", Data::Get("autostart")),
                                )),
                            )),
                        )),
                        $html->element("div", array("class" => "col-sm-6"), array(
                            $html->element("div", array("class" => "form-group"), array(
                                $html->label("primary", "control-label", "Player Rendering Mode"),
                                $html->tip("Sets the default player rendering mode"),
                                $html->element("select", array("class" => "form-control", "id" => "primary", "name" => "primary"), array(
                                    $html->option("HTML5", "html5", Data::Get("primary")),
                                    $html->option("Flash", "flash", Data::Get("primary")),
                                )),
                            )),
                        )),
                    )),
                )),
                $html->element("div", array("class" => "col-lg-4 col-md-6"), array(
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("jwp_key", "control-label", "JW Player License Key"),
                        $html->tip("Enter JW Player License Key"),
                        $html->input("text", "form-control", "jwp_key", "jwp_key", Data::Get("jwp_key"), "JW Player License Key"),
                    )),
                    $html->element("div", array("class" => "form-group"), array(
                        $html->label("about_link", "control-label", "About Link"),
                        $html->tip("Custom URL to link to when clicking the right-click menu of JW Player"),
                        $html->input("text", "form-control", "about_link", "about_link", Data::Get("about_link")),
                    )),
                    $html->element("div", array("class" => "row"), array(
                        $html->element("div", array("class" => "col-sm-6"), array(
                            $html->element("div", array("class" => "form-group"), array(
                                $html->label("font_size", "control-label", "Subtitle Font Size"),
                                $html->tip("Enter Subtitle Font Size"),
                                $html->input("text", "form-control", "font_size", "font_size", Data::Get("font_size"), "Enter Subtitle Font Size"),

                            )),
                        )),
                        $html->element("div", array("class" => "col-sm-6"), array(
                            $html->element("div", array("class" => "form-group"), array(
                                $html->label("font_color", "control-label", "Subtitle Font Color"),
                                $html->tip("Can be any hexadecimal color value"),
                                $html->input("text", "form-control", "font_color", "font_color", Data::Get("font_color"), "Enter Subtitle Font Color"),

                            )),
                        )),
                        $html->element("div", array("class" => "col-sm-6"), array(
                            $html->element("div", array("class" => "form-group"), array(
                                $html->label("font_family", "control-label", "Subtitle Font Family"),
                                $html->tip("Use this option to change the font family"),
                                $html->input("text", "form-control", "font_family", "font_family", Data::Get("font_family"), "Enter Subtitle Font Family"),

                            )),
                        )),
                        $html->element("div", array("class" => "col-sm-6"), array(
                            $html->element("div", array("class" => "form-group"), array(
                                $html->label("bg_color", "control-label", "Subtitle Background Color"),
                                $html->tip("This is the highlight color of the text. All HEX color values are accepted"),
                                $html->input("text", "form-control", "bg_color", "bg_color", Data::Get("bg_color"), "Enter Subtitle Background Color"),

                            )),
                        )),
                        $html->element("div", array("class" => "col-sm-6"), array(
                            $html->element("div", array("class" => "form-group"), array(
                                $html->label("share_btn", "control-label", "Share Button"),
                                $html->tip("Whether the Share Button will be visible or not"),
                                $html->element("select", array("class" => "form-control", "id" => "share_btn", "name" => "share_btn"), array(
                                    $html->option("Enable", "on", Data::Get("share_btn")),
                                    $html->option("Disable", "off", Data::Get("share_btn")),
                                )),
                            )),
                        )),
                        $html->element("div", array("class" => "col-sm-6"), array(
                            $html->element("div", array("class" => "form-group"), array(
                                $html->label("dl_btn", "control-label", "Download Button"),
                                $html->tip("Whether the Download Button will be visible or not"),
                                $html->element("select", array("class" => "form-control", "id" => "dl_btn", "name" => "dl_btn"), array(
                                    $html->option("Enable", "on", Data::Get("dl_btn")),
                                    $html->option("Disable", "off", Data::Get("dl_btn")),
                                )),
                            )),
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
    $("#player").bind("change",function(){
        $player = $(this).val();
        if ($player == "jwplayer") {
            $("#jwp_key").prop("disabled", false);
            $("#primary").prop("disabled", false);
            $("#about_text").prop("disabled", false);
            $("#about_link").prop("disabled", false);
            $("#share_btn").prop("disabled", false);
        } else {
            $("#jwp_key").prop("disabled", true);
            $("#primary").prop("disabled", true);
            $("#about_text").prop("disabled", true);
            $("#about_link").prop("disabled", true);
            $("#share_btn").prop("disabled", true);
        }
        if ($player == "jcplayer") {
            $("#share_btn").prop("disabled", false);
        }
    });
    $("#player").trigger("change");
');
require_once ADMINPATH . '/footer.php';
