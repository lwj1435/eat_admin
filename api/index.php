<?php
header("Content-type: text/html; charset=utf-8");
include dirname(__FILE__).'/config.inc.php';
include dirname(__FILE__).'/uc_client/client.php'; 

// change the following paths if necessary
$yii=dirname(__FILE__).'/../framework/yii.php';
$config=dirname(__FILE__).'/protected/config/main.php';

// remove the following lines when in production mode
defined('YII_DEBUG') or define('YII_DEBUG',true);
// specify how many levels of call stack should be shown in each log message
defined('YII_TRACE_LEVEL') or define('YII_TRACE_LEVEL',3);

require_once(dirname(__FILE__).'/protected/function/function.php');
require_once($yii);

Yii::createWebApplication($config)->run();
