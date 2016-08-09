<?php
define('MODE', 'DEVELOPMENT'); // DEVELOPMENT | PRODUCTION

define('APP_DIR', __DIR__.'/..');
define('TEMPLATES_DIR', APP_DIR . '/templates');

define('WWW_DIR', APP_DIR . '/../www');

define('CSS_REFRESH', '1');
define('JS_REFRESH', '1');

define('URL_HOMAPAGE','./');

define('URL_WEB', (MODE == 'DEVELOPMENT') ? 'http://localhost/www.flyparti.com/website' : 'http://student.vsmie.cz/~borzj3ak');

define('WEB_TITLE','Flyparti - letecká společnost');

/* Nastavení připojení */
// pro produkční mód
define('DB_SERVER_NAME_PRODUCTION', 'localhost');
define('DB_USER_NAME_PRODUCTION', 'borzj3ak');
define('DB_PASSWORD_PRODUCTION', 'z3WnThAsdP');
define('DB_NAME_PRODUCTION', 'borzj3ak');

// pro vývojový mód
define('DB_SERVER_NAME_DEVELOPMENT', 'localhost');
define('DB_USER_NAME_DEVELOPMENT', 'root');
define('DB_PASSWORD_DEVELOPMENT', 'kubik');
define('DB_NAME_DEVELOPMENT', 'flyparti');

