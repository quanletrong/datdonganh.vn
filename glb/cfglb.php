<?php
if (!defined('CUSTOM_CHECK_GLB')){header("Location: upgrade");die();}
else
{
	// define http protocol
	define('HTTP_PROTOCOL', 'https');

	//safelist db
    define('DB_MASTER_HOST', 'localhost'); // 82.180.152.103
    define('DB_MASTER_USER', 'u966959669_root');
    define('DB_MASTER_PASS', 'Lequan@FJ2002_v1');
    define('DB_MASTER_DBNAME', 'u966959669_datdonganh');

    define('DB_SLAVE_HOST', 'localhost'); // 82.180.152.103
    define('DB_SLAVE_USER', 'u966959669_root');
    define('DB_SLAVE_PASS', 'Lequan@FJ2002_v1');
    define('DB_SLAVE_DBNAME', 'u966959669_datdonganh');

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