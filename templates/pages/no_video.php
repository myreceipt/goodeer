<?php
if (!defined("JUICYCODES")) {
    exit;
}
use IT\Data;
echo '
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
        <title>' . Data::Get("default_title") . '</title>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700">
        <link rel="stylesheet" href="' . Data::Get("url") . '/templates/pages/assets/style.css">
    </head>
    <body>
        <div id="wrapper">
            <div class="vertical-align-wrap">
                <div class="vertical-align-middle">
                    <div class="content">
                        <div class="content-box">
                            <div class="header">
                                <div class="title">404 - NOT FOUND!</div>
                            </div>
                            <div class="error_message">
                                Your are seeing this error because the video you attempted to access was not found.<br/>
                                If you think that\'s an error please inform the website owner.
                            </div>
                        </div>
                    </div>
                    <div class="juicycodes">DEVELOPED BY <a href="https://juicycodes.com" target="_blank">JUICYCODES.COM</a>.</div>
                </div>
            </div>
        </div>
    </body>
</html>
';
