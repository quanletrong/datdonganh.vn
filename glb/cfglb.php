<?php
if (!defined('CUSTOM_CHECK_GLB')){header("Location: upgrade");die();}
else
{
	// define http protocol
	define('HTTP_PROTOCOL', 'http');

	//safelist db
    define('DB_MASTER_HOST', '127.0.0.1');
    define('DB_MASTER_USER', 'root');
    define('DB_MASTER_PASS', '');
    define('DB_MASTER_DBNAME', 'datdonganh');

    define('DB_SLAVE_HOST', '127.0.0.1');
    define('DB_SLAVE_USER', 'root');
    define('DB_SLAVE_PASS', '');
    define('DB_SLAVE_DBNAME', 'datdonganh');

	// email
	define('EMAIL_SMTP_HOST', '');
	define('EMAIL_SMTP_USER', '');
	define('EMAIL_SMTP_PASS', '');
	define('EMAIL_SMTP_PORT', '');

	// sms config
	define('SMS_URL', '');
	define('SMS_ACCOUNT', '');
	define('SMS_PASS', '');
	define('SMS_BRAND_NAME', '');
}