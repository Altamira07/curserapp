<?php
	##Variables del sistema
define('ZONA_HORARIA'	,"Mexico/General");
define('PATHAPP', '/var/www/html/curserapp/');
define('LIB', 'lib/');
define('TEMPLATES', 'templates/');
define('TEMPLATES_C', 'templates_c/');
define('CACHE', 'cache/');
define('CONFIGS', 'configs/');
define('DB_DBMS', 'mysql');
define('DB_HOST', 'localhost');
define('DB_NAME', 'curserapp');
define('DB_USER', 'curserapp');
define('DB_PASS', '1234');
define('PATHLIB',PATHAPP.LIB);
##Constantes del envio de correo electronico
define ('MAIL_SMTPAUTH',true);
define ('MAIL_SMTPSECURE','ssl');
define('MAIL_HOST','smtp.gmail.com');
define ('MAIL_USERNAME','');
define ('MAIL_PASS','');
define ('MAIL_SMTPDEBUG',2);
define ('MAIL_PORT',465);
?>
