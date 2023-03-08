<?php

// Load .env file
\Dotenv\Dotenv::createImmutable(__DIR__ . '\\..\\..', '.env')->load();

// DB Params
define("DBMS", $_ENV['DBMS']);
define("DB_HOST", $_ENV['DB_HOST']);
define("DB_PORT", $_ENV['DB_PORT']);
define("DB_USER", $_ENV['DB_USER']);
define("DB_PASS", $_ENV['DB_PASS']);
define("DB_NAME", $_ENV['DB_NAME']);

// App Root
define('APPROOT', dirname(dirname(__FILE__)));

// App Root
define('STATIC_DIR', dirname(dirname(dirname(__FILE__))) . '\\' . $_ENV['STATIC_DIR']);

// URL Root
define('DOMAIN', $_ENV['DOMAIN']);
define('URLROOT', (isset($_SERVER['HTTPS']) ? 'https://' : 'http://') . $_ENV['DOMAIN']);

// Site Name
define('SITENAME', $_ENV['SITE_NAME']);

// Cookie
define('COOKIE_LIFE_TIME', $_ENV['COOKIE_LIFE_TIME']);

define('MAX_AVTAR_SIZE', (int)filter_var($_ENV['MAX_AVTAR_SIZE'], FILTER_SANITIZE_NUMBER_INT));
