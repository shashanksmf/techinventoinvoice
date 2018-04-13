<?php
// Error Reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

// SSL
if ((isset($_SERVER['HTTPS']) && (($_SERVER['HTTPS'] == 'on') || ($_SERVER['HTTPS'] == '1'))) || $_SERVER['SERVER_PORT'] == 443) {
	$protocol = 'https://';
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
	$protocol = 'https://';
} else {
	$protocol = 'http://';
}

// Configuration
define('HTTP_SERVER', $protocol . $_SERVER['HTTP_HOST'] . rtrim(dirname($_SERVER['SCRIPT_NAME']), '/.\\') . '/');
define('HTTP_APPLICATION', $protocol . $_SERVER['HTTP_HOST'] . rtrim(rtrim(dirname($_SERVER['SCRIPT_NAME']), 'install'), '/.\\') . '/');
define('DIR_APPLICATION', $_SERVER['HTTP_HOST'].'/application/');
define('DIR_SOFTWARE', str_replace('\'', '/', realpath(DIR_APPLICATION . '../')) . '/');
define('DIR_SYSTEM', $_SERVER['HTTP_HOST'].'/system/');
define('DIR_DATABASE', DIR_SYSTEM . 'library/database/');
define('DIR_LANGUAGE', DIR_APPLICATION . 'language/');
define('DIR_TEMPLATE', DIR_APPLICATION . 'view/');
define('_FRONT', false);

echo DIR_SYSTEM.'/'.DIR_APPLICATION;
// Startup
// define("DIR_SYSTEM",str_replace('\'', '/', realpath(dirname(__FILE__) . '/../')) . '/system/');
echo constant("DIR_SYSTEM");

require_once('./../system/startup.php');

// Registry
$registry = new Registry();

// Loader
$loader = new Loader($registry);
$registry->set('load', $loader);

require_once('./../system/library/url.php');
require_once('./../system/library/request.php');
require_once('./../system/library/response.php');
require_once('./../system/library/session.php');
require_once('./../system/library/language.php');
require_once('./../system/library/front.php');
// Url
$url = new Url("https://easyinvoice.scalingo.io","");
$registry->set('url', $url);

// Request
$request = new Request();
$registry->set('request', $request);

// Response
$response = new Response();
$response->addHeader('Content-Type: text/html; charset=utf-8');
$registry->set('response', $response);

// Session
$session = new Session();
$registry->set('session', $session);

// Language
$language = new Language('en-gb');
$language->load('default');
$registry->set('language', $language);

// Front Controller
$controller = new Front($registry);

// Upgrade
$upgrade = false;

if (file_exists('../config.php')) {
    if (filesize('../config.php') > 0) {
		require_once('../config.php');

        $upgrade = true;
    }
}

// Action
if (isset($request->get['load'])) {
    $action = new Action($request->get['load']);
} elseif ($upgrade) {
    $action = new Action('upgrade/upgrade');
} else {
    $action = new Action('install/step_1');
}

// Dispatch
$controller->dispatch($action, new Action('error/not_found'));

// Output
$response->output();
