<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
global  $dbname;
global  $dbusername;
global  $dbpassword;


return array(
	'language'=>'zh_cn',
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'My Web Application',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'ext.HttpClient.*',
		'ext.function.*',
		'ext.bug.*',
		'ext.dataBase.*',
		'ext.dao.*',
		'ext.fileUpload.*',
		'application.modules.srbac.controllers.SBaseController',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
			
			'srbac'=>array(
					'userclass'=>'Admin',//根据实际用户model类设置
					'userid'=>'id',
					'username'=>'username',
					// 如果设置为true, 则会跳过权限控制
					'debug'=>true,
					'pageSize'=>10,
// 					'superUser'=>'test',
					'css'=>'srbac.css',
					'layout'=>'application.views.layouts.main',
					'notAuthorizedView'=>'srbac.views.authitem.unauthorized',
					'alwaysAllowed'=>array('SiteLogin','SiteLogout','SiteIndex','SiteAdmin', 'SiteError', 'SiteContact'),
					'userActions'=>array('show','View','List'),
					'listBoxNumberOfLines'=>15,
					'imagesPath'=>'srbac.images',
					'imagesPack'=>'noia',
					'iconText'=>true,
					'header'=>'srbac.views.authitem.header',
					'footer'=>'srbac.views.authitem.footer',
					'showHeader'=>true,
					'showFooter'=>true,
					'alwaysAllowedPath'=>'srbac.components',
			),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format
		
		'db'=>array(
			'connectionString' => 'mysql:host=59.63.181.62;dbname='.$dbname.'',
			'emulatePrepare' => true,
			'username' => $dbusername,
			'password' => $dbpassword,
			'charset' => 'utf8',
		),
			'authManager'=>array(
					'class'=>'application.modules.srbac.components.SDbAuthManager',
					'connectionID'=>'db',
					'itemTable'=>'items',
					'assignmentTable'=>'assignments',
					'itemChildTable'=>'itemchildren',
			),
		'urlManager'=>array(
			'urlFormat'=>'path',
			'showScriptName' => false,//隐藏index.php
			'urlSuffix' => '.html',//后缀
				
			'rules'=>array(
// 				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
// 				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
// 				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		
		'errorHandler'=>array(
			// use 'site/error' action to display errors
			'errorAction'=>'site/error',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				// uncomment the following to show log messages on web pages
				/*
				array(
					'class'=>'CWebLogRoute',
				),
				*/
			),
		),
		
		'cache'=>array(
            'class'=>'system.caching.CMemCache',
            'servers'=>array(
                array('host'=>'127.0.0.1','port'=>11211,'weight'=>60),
                array('host'=>'127.0.0.1','port'=>11211,'weight'=>40),
            ),
//            'keyPrefix' =>'', 
//		    'hashKey' => false, 
//		    'serializer' => false,
        ),
		
// 		'session'=>array(
// 		   'autoStart'=>true,
// 		   'sessionName'=>'test.com',
// 		   'cookieMode'=>'only',
// 		   'savePath'=>'./cache',
// 		),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
		'redismaster'=>array(
			"hostname" => "127.0.0.1",
        	"port" => 6379
		),
			'api'=>'http://api.77tng.com/'
		//'api'=>'http://test.77tng.com/api/index.php?r='
	),
);

