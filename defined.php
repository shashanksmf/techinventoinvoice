<?php
$path = getcwd();
define('_URL', $path);
define('_SURL',$path);
define('_PATH', __DIR__ . '/application');
define('_FRONT', true);

defined('_PATH') or die('Restricted!');
define('VERSION', '1.3.0a');
define('HTTP_SERVER', "https://easyinvoice.scalingo.io");
define('HTTP_APPLICATION', "https://easyinvoice.scalingo.io");
define('HTTPS_SERVER', "https://easyinvoice.scalingo.io");
define('HTTPS_APPLICATION', "https://easyinvoice.scalingo.io");
define('DIR_APPLICATION', __DIR__);
define('DIR_EXTENSION', __DIR__."/extension/");
define('DIR_IMAGE', __DIR__."/image/");
define('DIR_LANGUAGE', __DIR__."/language/");
define('DIR_SYSTEM', __DIR__."/system/");
define('DIR_TEMPLATE', __DIR__."/view/");
define('DB_DRIVER', 'mysqli');

define('DB_HOSTNAME', 'fb1cdd50-5bd5-4c69-9222-37aa532835c7.easyinvoice-5720.mysql.dbs.scalingo.com:30867');
define('DB_USERNAME', 'easyinvoicedbuser');
define('DB_PASSWORD', 'easyinvoicedbuser');
define('DB_DATABASE', 'easyinvoice_5720');


// define('DB_HOSTNAME', 'us-cdbr-iron-east-05.cleardb.net');
// define('DB_USERNAME', 'bcada21bc58477');
// define('DB_PASSWORD', '96a24738');
// define('DB_DATABASE', 'heroku_51173485efddc6a');
