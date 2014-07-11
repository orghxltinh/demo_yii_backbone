<?php

// change the following paths if necessary
error_reporting(E_ALL | E_STRICT);
date_default_timezone_set('Asia/Ho_Chi_Minh');

define('DS',DIRECTORY_SEPARATOR);
define('PS',PATH_SEPARATOR);
define('ROOT',  dirname(__FILE__));
define('YII_PROTECTED_DIR',ROOT . DS . 'protected');
define('YII_THEME_DIR',ROOT . DS . 'themes');

$yii=dirname(__FILE__).'/fw/framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once($yii);
Yii::createWebApplication($config)->run();