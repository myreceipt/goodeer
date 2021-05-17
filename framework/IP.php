<?php
namespace IT;

use IT\Tools;

/**
 * Simple IP information fetcher & IP checker class
 * @package IT\IP
 * @author JuicyCodes
 * @version 1.0.5
 * @created 05-04-2017 07:10 PM
 * @modified 07-04-2017 11:26 PM
 */
class IP
{
    private static $details = array();

    /**
     * Get IP Details
     * @param bool|string $ip
     */
    public static function Details($ip = false)
    {
        $ip = self::IP($ip);
        if (empty(self::$details[$ip])) {
            $api = self::get_contents("http://ip-api.com/json/$ip");
            if ($api->status == "success" && $api->data->status == "success") {
                unset($api->data->status);
                self::$details[$ip] = $api->data;
            } else {
                return false;
            }
        }
        return self::$details[$ip];
    }

    /**
     * Get & vaildate IP Address
     * @param bool|string $ip
     */
    public static function IP($ip = false)
    {
        if ($ip) {
            $ip = $ip;
        } else {
            $ip_keys = array(
                'HTTP_CLIENT_IP',
                'HTTP_X_FORWARDED_FOR',
                'HTTP_X_FORWARDED',
                'HTTP_X_CLUSTER_CLIENT_IP',
                'HTTP_FORWARDED_FOR',
                'HTTP_FORWARDED',
                'REMOTE_ADDR',
            );
            foreach ($ip_keys as $key) {
                if (array_key_exists($key, $_SERVER) === true) {
                    foreach (explode(',', $_SERVER[$key]) as $ip) {
                        $ip = trim($ip);
                        break;
                    }
                    break;
                }
            }
        }
        if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
            return $ip;
        } else {
            return false;
        }
    }

    /**
     * Create a cURL request
     * @param  string $url
     * @return object
     */
    private static function get_contents($url)
    {

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        $result = curl_exec($ch);
        $info   = curl_getinfo($ch);
        if (empty($result) || $info["http_code"] != "200") {
            $error = true;
        }
        curl_close($ch);
        if (empty($error)) {
            $return = array("status" => "success", "data" => json_decode($result));
        } else {
            $return = array("status" => "error");
        }
        return Tools::Object($return);
    }

    /**
     * Checks if an IPv4 or IPv6 address is contained in the list of given IPs or subnets.
     *
     * @see https://github.com/symfony/http-foundation
     *
     * @param string       $requestIp IP to check
     * @param string|array $ips       List of IPs or subnets (can be a string if only a single one)
     *
     * @return bool Whether the IP is valid
     */
    public static function Check($requestIp, $ips)
    {
        if (!is_array($ips)) {
            $ips = array($ips);
        }
        $method = substr_count($requestIp, ':') > 1 ? 'checkIp6' : 'checkIp4';
        foreach ($ips as $ip) {
            if (self::$method($requestIp, $ip)) {
                return true;
            }
        }
        return false;
    }

    /**
     * Compares two IPv4 addresses.
     * In case a subnet is given, it checks if it contains the request IP.
     *
     * @see https://github.com/symfony/http-foundation
     *
     * @param string $requestIp IPv4 address to check
     * @param string $ip        IPv4 address or subnet in CIDR notation
     *
     * @return bool Whether the request IP matches the IP, or whether the request IP is within the CIDR subnet
     */
    private static function checkIp4($requestIp, $ip)
    {
        if (!filter_var($requestIp, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4)) {
            return false;
        }
        if (false !== strpos($ip, '/')) {
            list($address, $netmask) = explode('/', $ip, 2);
            if ($netmask === '0') {
                return filter_var($address, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
            }
            if ($netmask < 0 || $netmask > 32) {
                return false;
            }
        } else {
            $address = $ip;
            $netmask = 32;
        }
        return 0 === substr_compare(sprintf('%032b', ip2long($requestIp)), sprintf('%032b', ip2long($address)), 0, $netmask);
    }

    /**
     * Compares two IPv6 addresses.
     * In case a subnet is given, it checks if it contains the request IP.
     *
     * @author David Soria Parra <dsp at php dot net>
     *
     * @see https://github.com/dsp/v6tools
     *
     * @param string $requestIp IPv6 address to check
     * @param string $ip        IPv6 address or subnet in CIDR notation
     *
     * @return bool Whether the IP is valid
     *
     * @throws \RuntimeException When IPV6 support is not enabled
     */
    private static function checkIp6($requestIp, $ip)
    {
        if (!((extension_loaded('sockets') && defined('AF_INET6')) || @inet_pton('::1'))) {
            throw new \RuntimeException('Unable to check Ipv6. Check that PHP was not compiled with option "disable-ipv6".');
        }
        if (false !== strpos($ip, '/')) {
            list($address, $netmask) = explode('/', $ip, 2);
            if ($netmask < 1 || $netmask > 128) {
                return false;
            }
        } else {
            $address = $ip;
            $netmask = 128;
        }
        $bytesAddr = unpack('n*', @inet_pton($address));
        $bytesTest = unpack('n*', @inet_pton($requestIp));
        if (!$bytesAddr || !$bytesTest) {
            return false;
        }
        for ($i = 1, $ceil = ceil($netmask / 16); $i <= $ceil; ++$i) {
            $left = $netmask - 16 * ($i - 1);
            $left = ($left <= 16) ? $left : 16;
            $mask = ~(0xffff >> $left) & 0xffff;
            if (($bytesAddr[$i] & $mask) != ($bytesTest[$i] & $mask)) {
                return false;
            }
        }
        return true;
    }
}
