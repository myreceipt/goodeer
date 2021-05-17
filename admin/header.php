<?php
if (!defined("JUICYCODES")) {
    exit;
}

$user->CheckLogin($html->url("login"));
$html->GetHeader();
$html->element("div", array("id" => "wrapper"), array(
    $html->element("div", array("class" => "sidebar"), array(
        $html->element("div", array("class" => "brand"), array(
            $html->element("a", array("href" => $var->url), array(
                $html->element("img", array("src" => $var->url . "/assets/img/juicycodes.png", "alt" => "JUICYCODES.COM", "class" => "img-responsive logo")),
            )),
        )),
        $html->element("div", array("class" => "sidebar-scroll"), array(
            $html->element("nav", false, array(
                $html->element("ul", array("class" => "nav"), array(
                    $html->element("li", false, array(
                        $html->element("a", array("href" => $html->Url(null), "class" => $html->get_class("dashboard")), array(
                            $html->element("i", array("class" => "fa fa-tachometer")),
                            $html->element("span", false, array("Dashboard")),
                        )),
                    )),
                    $html->element("li", false, array(
                        $html->element("a", array("href" => $html->Url("add/link"), "class" => $html->get_class("add_link")), array(
                            $html->element("i", array("class" => "fa fa-link")),
                            $html->element("span", false, array("Add Link")),
                        )),
                    )),
                    $html->element("li", false, array(
                        $html->element("a", array("href" => $html->Url("add/links"), "class" => $html->get_class("add_links")), array(
                            $html->element("i", array("class" => "fa fa-plus")),
                            $html->element("span", false, array("Add Bulk Links")),
                        )),
                    )),
                    $html->element("li", false, array(
                        $html->element("a", array("href" => $html->Url("manage/links"), "class" => $html->get_class("manage_links")), array(
                            $html->element("i", array("class" => "fa fa-bars")),
                            $html->element("span", false, array("Manage Links")),
                        )),
                    )),
                    $html->element("li", false, array(
                        $html->element("a", array("href" => $html->Url("manage/users"), "class" => $html->get_class("manage_users")), array(
                            $html->element("i", array("class" => "fa fa-users")),
                            $html->element("span", false, array("Manage Users")),
                        )),
                    ), false, array(
                        array($user->Info("role"), "==", "1"),
                    )),
                    $html->element("li", false, array(
                        $html->element("a", array(
                            "href" => "#settings", "data-toggle" => "collapse", "class" => $html->get_class("manage_settings", "collapsed")), array(
                            $html->element("i", array("class" => "fa fa-sliders")),
                            $html->element("span", false, array("Manage Settings")),
                            $html->element("i", array("class" => "icon-submenu lnr lnr-chevron-left")),
                        )),
                        $html->element("div", array("id" => "settings", "class" => "collapse"), array(
                            $html->element("ul", array("class" => "nav"), array(
                                $html->element("li", false, array(
                                    $html->element("a", array("href" => $html->Url("settings/general")), array(
                                        "General Settings",
                                    )),
                                )),
                                $html->element("li", false, array(
                                    $html->element("a", array("href" => $html->Url("settings/optimizer")), array(
                                        "Optimizer Settings",
                                    )),
                                )),
                                $html->element("li", false, array(
                                    $html->element("a", array("href" => $html->Url("settings/misc")), array(
                                        "Misc Settings",
                                    )),
                                )),
                                $html->element("li", false, array(
                                    $html->element("a", array("href" => $html->Url("settings/player")), array(
                                        "Player Settings",
                                    )),
                                )),
                                $html->element("li", false, array(
                                    $html->element("a", array("href" => $html->Url("settings/advertise")), array(
                                        "Advertise Settings",
                                    )),
                                )),
                                $html->element("li", false, array(
                                    $html->element("a", array("href" => $html->Url("settings/firewall")), array(
                                        "Firewall Settings",
                                    )),
                                )),
                            )),
                        )),
                    ), false, array(
                        array($user->Info("role"), "==", "1"),
                    )),
                    $html->element("li", false, array(
                        $html->element("a", array("href" => $html->Url("log/list"), "class" => $html->get_class("list_log")), array(
                            $html->element("i", array("class" => "fa fa-paw")),
                            $html->element("span", false, array("Login Log")),
                        )),
                    )),
                )),
            )),
        )),
        $html->element("a", array("class" => "footer", "href" => "https://support.juicycodes.com"), array(
            $html->element("i", array("class" => "fa fa-life-ring")),
            $html->element("span", false, array("SUPPORT CENTER")),
        )),
    )),
    $html->element("div", array("class" => "main"), array(
        $html->element("nav", array("class" => "navbar navbar-default"), array(
            $html->element("div", array("class" => "container-fluid"), array(
                $html->element("div", array("class" => "navbar-btn"), array(
                    $html->element("button", array("type" => "button", "class" => "btn-toggle-fullwidth"), array(
                        $html->element("i", array("class" => "lnr lnr-arrow-left-circle")),
                    )),
                )),
                $html->element("div", array("class" => "navbar-header"), array(
                    $html->element("button", array("type" => "button", "class" => "navbar-toggle collapsed", "data-toggle" => "collapse", "data-target" => "#navbar-menu"), array(
                        $html->element("i", array("class" => "sr-only"), array("Toggle Navigation")),
                        $html->element("i", array("class" => "fa fa-bars icon-nav")),
                    )),
                )),
                $html->element("div", array("id" => "navbar-menu", "class" => "navbar-collapse collapse"), array(
                    $html->element("ul", array("class" => "nav navbar-nav navbar-right"), array(
                        $html->element("li", array("class" => "dropdown"), array(
                            $html->element("a", array("href" => "#", "class" => "dropdown-toggle", "data-toggle" => "dropdown"), array(
                                $html->element("img", array("src" => $user->Avatar(), "alt" => "Avatar", "class" => "img-circle")),
                                $html->element("span", false, array(" ", $user->Info("name"), " ")),
                                $html->element("i", array("class" => "icon-submenu lnr lnr-chevron-down")),
                            )),
                            $html->element("ul", array("class" => "dropdown-menu"), array(
                                $html->element("li", false, array(
                                    $html->element("a", array("href" => $html->url("user/edit/{$user->id}")), array(
                                        $html->element("i", array("class" => "lnr lnr-cog")),
                                        $html->element("span", false, array("Edit Profile")),
                                    )),
                                )),
                                $html->element("li", false, array(
                                    $html->element("a", array("href" => $html->url("user/logout")), array(
                                        $html->element("i", array("class" => "lnr lnr-exit")),
                                        $html->element("span", false, array("Logout")),
                                    )),
                                )),
                            )),
                        )),
                    )),
                )),
            )),
        )),
        $html->element("div", array("class" => "main-content"), array(
            $html->element("div", array("class" => "container-fluid"), array(
            ), false, false, false),
        ), false, false, false),
    ), false, false, false),
), true, false, false);
