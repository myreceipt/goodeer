<?php
require_once 'config.php';

// Truncate `cache` & `links` table
$cache = $db->query("TRUNCATE TABLE `cache`");
$links = $db->query("TRUNCATE TABLE `links`");

if ($cache && $links) {
    echo "Script successfully upgraded to latest version!";
    unlink(__FILE__);
} else {
    echo "Error: " . $db->error;
}
