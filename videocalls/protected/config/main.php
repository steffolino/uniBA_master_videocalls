<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
return array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name'=>'Video Calls',
	'defaultController' => 'site/login',

	// preloading 'log' component & yii booster extension (carousel)
	'preload'=>array(
		'log',
		'booster',
	),	
	//added by stef
	//Requires a User to Log-In for viewing pages
	'behaviors' => array(
		'onBeginRequest' => array(
			'class' => 'application.components.RequireLogin'
		)
	),
	//yiistrap stuff
    // path aliases
    'aliases' => array(
        // yiistrap configuration
        'bootstrap' => realpath(__DIR__ . '/../extensions/bootstrap'), // change if necessary
		'booster' => realpath (__DIR__ . '/../extensions/yiibooster'),
		'vendor.twbs.bootstrap.dist' => realpath(__DIR__ . '/../extensions/bootstrap'),
    ),

	
	// autoloading model and component classes
	'import'=>array(
		'application.models.*',
		'application.components.*',
		//yiistrap
        'bootstrap.helpers.TbHtml',
        'bootstrap.components.TbApi',
        'bootstrap.helpers.TbArray',
		//'bootstrap.helpers.*',
		//'bootstrap.components.*',
		//'bootstrap.widgets.TbBreadcrumb',
		'bootstrap.behaviors.TbWidget',
		'bootstrap.widgets.TbActiveForm',
		'bootstrap.assets.css.*',
	),
	
	'modules'=>array(
		// uncomment the following to enable the Gii tool
		/*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Enter Your Password Here',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','::1'),
		),
		*/
		//yiistrap
		'gii' => array(
            'generatorPaths' => array('bootstrap.gii'),
        ),
	),

	// application components
	'components'=>array(
		'booster' => array(
			'class' => 'booster.components.booster',
		),	
	    // yiistrap configuration
        'bootstrap' => array(
            'class' => 'bootstrap.components.TbApi',
        ),
        // yiiwheels configuration
        /*'yiiwheels' => array(
            'class' => 'yiiwheels.YiiWheels',   
        ),
		*/
		'user'=>array(
			// enable cookie-based authentication
			'allowAutoLogin'=>true,
		),

		// uncomment the following to enable URLs in path-format
		/*
		'urlManager'=>array(
			'urlFormat'=>'path',
			'rules'=>array(
				'<controller:\w+>/<id:\d+>'=>'<controller>/view',
				'<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
				'<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
			),
		),
		*/

		// database settings are configured in database.php
		'db'=>require(dirname(__FILE__).'/database.php'),

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
				
				// array(
					// 'class'=>'CWebLogRoute',
				// ),
				
			),
		),

	),

	// application-level parameters that can be accessed
	// using Yii::app()->params['paramName']
	'params'=>array(
		// this is used in contact page
		'adminEmail'=>'webmaster@example.com',
	),
);
