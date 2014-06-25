<?php
// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'球讯',
	'language'=>'zh',
	// preloading 'log' component
	'preload'=>array('log'),

	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		'ext.YiiRedis-master.*',
		'ext.bug.*',
		'ext.dataBase.*',
	),

	'modules'=>array(
		// uncomment the following to enable the Gii tool
		
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'123',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		
//	    'srbac' => array(
//	    	'userclass'=>'User', //可选,默认是 User
//	        'userid'=>'user_id', //可选,默认是 userid
//	        'username'=>'username', //可选，默认是 username
//			'delimeter'=>'@',
//	        'debug'=>false, //可选,默认是 false
//	        'pageSize'=>15, //可选，默认是 15
//	        'superUser' =>'管理员', //可选，默认是 Authorizer
//	        'css'=>'srbac.css', //可选，默认是 srbac.css
////	        'layout'=>'application.views.layouts.column1', //可选,默认是
//	                  // application.views.layouts.main, 必须是一个存在的路径别名
//	        'notAuthorizedView'=>'srbac.views.authitem.unauthorized', // 可选,默认是unauthorized.php
//	                 //srbac.views.authitem.unauthorized, 必须是一个存在的路径别名
//	        'alwaysAllowed'=>array(    //可选,默认是 gui
//	        	'SiteLogin','SiteLogout','SiteIndex','SiteAdmin',
//	            'SiteError', 'SiteContact',''
//			),
//	        'userActions'=>array(//可选,默认是空数组
//	            'Show','View','List'
//			),
//	        'listBoxNumberOfLines' => 15, //可选,默认是10
//	        'imagesPath' => 'srbac.images', //可选,默认是 srbac.images
//	        'imagesPack'=>'noia', //可选,默认是 noia
//	        'iconText'=>true, //可选,默认是 false
//	        'header'=>'srbac.views.authitem.header', //可选,默认是
//	                       // srbac.views.authitem.header, 必须是一个存在的路径别名
//	        'footer'=>'srbac.views.authitem.footer', //可选,默认是
//	                       // srbac.views.authitem.footer, 必须是一个存在的路径别名
//	        'showHeader'=>true, //可选,默认是false
//	        'showFooter'=>true, //可选,默认是false
//	        'alwaysAllowedPath'=>'srbac.components', //可选,默认是 srbac.components
//		),
	),

	// application components
	'components'=>array(
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),
		// uncomment the following to enable URLs in path-format

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
		
//		'authManager' => array(
//	        'class' => 'srbac.components.SDbAuthManager',
//	        'connectionID' => 'db', //使用的数据库组
//	        'itemTable' => 'l_AuthItem', // 授权项目表 (默认:authitem)
//	        'assignmentTable' => 'l_AuthAssignment', // 授权分配表 (默认:authassignment)
//	        'itemChildTable' => 'l_AuthItemChild', // 授权子项目表 (默认:authitemchild)
//			'defaultRoles'=>array('authenticated','游客'),
//	    ),
		"redis" => array(
				"class" => "ext.YiiRedis-master.ARedisConnection",
				"hostname" => "127.0.0.1",
				"port" => 6379,
				"database" => 2,
//				"password" => '123456',
				"prefix" => "Yii.redis."
		),
    	"cache" => array(
        	"class" => "ext.yiiredis.ARedisCache"
   		 ),
	
		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host=59.63.181.62;dbname=ordering',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'goodgood',
			'charset' => 'utf8',
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
 		'objMySql'=>array(
 				"class" => "ext.dataBase.MySqlClass",
		),
		'objRedis'=>array(
				"class" => "ext.dataBase.MyRedisClass",
		),
		'objRuleTest'=>array(
				"class" => "ext.RuleTest",
		),
		
	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'471455261@qq.com',
		'rserver1'=>array(
			"hostname" => "127.0.0.1",
        	"port" => 6379
		),
		'rserver2'=>array(
			"hostname" => "127.0.0.1",
        	"port" => 6379
		),
		'redismaster'=>array(
			"hostname" => "127.0.0.1",
        	"port" => 6379
		),
	),
);


