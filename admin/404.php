<?php
require_once 'init.php';
$html->GetHeader();
echo '
<div id="wrapper">
	<div class="vertical-align-wrap">
		<div class="vertical-align-middle">
			<div class="auth-box lockscreen default-box">
				<div class="content text-center">
					<h1 class="text-danger">PAGE NOT FOUND</h1><br/><br/>
					<a href="' . ($_SERVER["HTTP_REFERER"] ?: $html->url(null)) . '" class="btn btn-default">Back</a>
				</div>
			</div>
			<div class="juicycodes">
				 Made with <i class="fa fa-heart heart"></i> by <a href="http://juicycodes.com">JUICYCODES.COM</a>.
			</div>
		</div>
	</div>
</div>
';
$html->GetFooter();
header("HTTP/1.0 404 Not Found");
