<?php
if (!defined("JUICYCODES")) {
    exit;
}
use IT\Data;
use IT\IP;

/**
 * Disable access baseed on referer
 */
if (Data::Get("accs_restriction") == "enable") {
    $domains = explode(",", Data::Get("allowed_domains"));
    $referer = parse_url($_SERVER["HTTP_REFERER"], PHP_URL_HOST);
    if (empty($referer) || !in_array($referer, $domains)) {
        header('HTTP/1.0 403 Forbidden');
        require TEMPLATES . "pages/access_denied.php";
        exit;
    }
}

/**
 * Disbale access baed on visitor country
 */
if (!empty(Data::Get("blocked_countries"))) {
    $country = IP::Details()->countryCode;
    if (!empty($country)) {
        $countries = explode(",", Data::Get("blocked_countries"));
        if (in_array($country, $countries)) {
            header('HTTP/1.0 403 Forbidden');
            require TEMPLATES . "pages/access_denied.php";
            exit;
        }
    }
}

/**
 * Disable access based on visitor IP/Subnet
 */
if (!empty(Data::Get("blocked_ips"))) {
    $ips = explode("\n", Data::Get("blocked_ips"));
    foreach ($ips as $ip) {
        if (strstr($ip, '/')) {
            $ranges[] = $ip;
        } else {
            $address[] = $ip;
        }
    }
    if (!empty($address)) {
        if (in_array(IP::IP(), $address)) {
            $access_denied = true;
        }
    }
    if (!empty($ranges)) {
        if (IP::Check(IP::IP(), $ranges)) {
            $access_denied = true;
        }
    }
    if ($access_denied === true) {
        header('HTTP/1.0 403 Forbidden');
        require TEMPLATES . "pages/access_denied.php";
        exit;
    }
}
