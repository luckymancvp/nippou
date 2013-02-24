<?php

// This is the configuration for yiic console application.
// Any writable CConsoleApplication properties can be configured here.
return array(
    'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
    'name'=>'Data Center',
    'timeZone'=>"Asia/Tokyo",

	'name'=>'My Console Application',

	// preloading 'log' component
	'preload'=>array('log'),

    'import'=>array(
        'application.models.*',
        'application.components.*',
        'application.extensions.KEmail.KEmail',
    ),

	// application components
	'components'=>array(
		'db'=>array(
			'connectionString' => 'mysql:host=localhost;dbname=nippou',
			'emulatePrepare' => true,
			'username' => 'root',
			'password' => 'root',
			'charset' => 'utf8',
		),
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
			),
		),
        'email'=>array(
            'class'=>'KEmail',
            'host_name'=>'mail.oneofthem.jp',
            'user'=>'tu@oneofthem.jp',
            'password'=>'tu@oneofthem.jp1210',
            //'authentication_mechanism'=>"login",
            'host_port'=>587,
            //'ssl'=>'true',
        ),
	),
);