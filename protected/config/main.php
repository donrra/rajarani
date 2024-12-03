<?php

// uncomment the following to define a path alias
// Yii::setPathOfAlias('local','path/to/local-folder');

// This is the main Web application configuration. Any writable
// CWebApplication properties can be configured here.
$lam_config =  array(
	'basePath'=>dirname(__FILE__).DIRECTORY_SEPARATOR.'..',
	'name' => 'Rajarani',
   	'theme' => 'rajarani',
	'defaultController' => 'user/home', 
	//'language' =>'da',
	

	// preloading 'log' component
	'preload'=>array(
//	'log',
),



'import'=>array(
		'application.models.*',
		'application.components.*',
        'application.modules.user.models.*',
        'application.modules.user.components.*',
        'application.modules.rights.*',
        'application.modules.rights.components.*',
	    'application.modules.user.*',
		'application.modules.poll.models.*',
		'application.modules.poll.components.*',
	
		'application.modules.backend.modules.user.models.*',
        'application.modules.backend.modules.user.components.*',
        'application.modules.backend.modules.rights.*',
        'application.modules.backend.modules.rights.components.*',
		'application.modules.backend.modules.user.*',
		'application.modules.backend.modules.page.models.*',
		'application.modules.backend.modules.translation.models.*',
		'application.extensions.galleryManager.models.*',
		'application.extensions.galleryManager.*',
		'application.extensions.tooltipster.*',
		),
	

	'modules'=>array(
	
	// poll
	'poll' => array(
       // Force users to vote before seeing results
       'forceVote' => TRUE,
       // Restrict anonymous votes by IP address,
       // otherwise it's tied only to user_id 
       'ipRestrict' => TRUE,
       // Allow guests to cancel their votes
       // if ipRestrict is enabled
       'allowGuestCancel' => FALSE,
     ),
	
	'backend'=>array(
				'class'=>'application.modules.backend.BackendModule',
				'defaultController' => 'user/login', 
			
			'modules'=>array(
			//users and rights
							'translation'=>array(
									'defaultController'=>'translation',
							),
							'page'=>array(
									'defaultController'=>'page',
							),
							'user'=>array(
									'tableUsers' => 'users',
									'tableProfiles' => 'profiles',
									'tableProfileFields' => 'profiles_fields',
							),
							'rights'=>array(
									'install'=>false,
									'debug'=>true,
									'enableBizRuleData'=>true,
									),
							'message' => array(
									'userModel' => 'User',
									'getNameMethod' => 'getFullName',
									'getSuggestMethod' => 'getSuggest',
								),	
							'poll' => array(
									// Force users to vote before seeing results
									'forceVote' => TRUE,
									// Restrict anonymous votes by IP address,
									// otherwise it's tied only to user_id 
									'ipRestrict' => TRUE,
									// Allow guests to cancel their votes
									// if ipRestrict is enabled
									'allowGuestCancel' => FALSE,
							),		
	   						)
	), 
	//users and rights
	 'user'=>array(
                'tableUsers' => 'users',
                'tableProfiles' => 'profiles',
                'tableProfileFields' => 'profiles_fields',
        ),
        'rights'=>array(
                'install'=>false,
				'debug'=>true,
				'enableBizRuleData'=>true,
				),
		'message' => array(
                'userModel' => 'User',
                'getNameMethod' => 'getFullName',
                'getSuggestMethod' => 'getSuggest',
				'defaultController'=>'inbox',
            ),
			'page'=>array(
						'defaultController'=>'page',
					  ),				
		// uncomment the following to enable the Gii tool
/*
		'gii'=>array(
			'class'=>'system.gii.GiiModule',
			'password'=>'Kafr!007',
			// If removed, Gii defaults to localhost only. Edit carefully to taste.
			'ipFilters'=>array('127.0.0.1','195.215.210.222'),
		),
*/
	),

	// application components
	'components'=>array(
	/* Check users browser*/
	'browser' => array(
    		'class' => 'application.extensions.browser.CBrowserComponent',
			),
	'Paypal' => array(
			'class'=>'application.components.Paypal',
			'apiUsername' => 'raheel_api1.norvida.com',
			'apiPassword' => 'NVJSNLDRXVZ677WM',
			'apiSignature' => 'AFcWxV21C7fd0v3bYYYRCpSSRl31AcYCL-G5kSb.r8XT8w1RgyXLJmq2',
			'apiLive' => true,
			
			'returnUrl' => '/user/paypal/confirm/', //regardless of url management component
			'cancelUrl' => '/user/paypal/cancel/', //regardless of url management component
		),
	'image'=>array(
            'class'=>'application.extensions.image.CImageComponent',
            // GD or ImageMagick
            'driver'=>'GD',
            // ImageMagick setup path
            'params'=>array('directory'=>'D:/Program Files/ImageMagick-6.4.8-Q16'),
        ),
		'user'=>array(
                'class'=>'RWebUser',
                // enable cookie-based authentication
                'allowAutoLogin'=>true,
                'loginUrl'=>array('/user/login'),
        ),
		'messages'=>array(
			'class'=>'CDbMessageSource',
			'sourceMessageTable'=>'lang_source',
	 		'translatedMessageTable'=>'lang',
			'onMissingTranslation' => array('MissingMessages', 'load')
		),

        'authManager'=>array(
			'class'=>'RDbAuthManager',
            'connectionID'=>'db',
            'itemTable'=>'authitem',
			'itemChildTable'=>'authitemchild',
			'assignmentTable'=>'authassignment',
			'rightsTable'=>'rights',
		),
		
		//Images ePHPThumb
		'phpThumb'=>array(
		'class'=>'ext.EPhpThumb.EPhpThumb',
		'options'=>array(),
		),
		'bootstrap' => array(
	    'class' => 'ext.bootstrap.components.Bootstrap',
	    'responsiveCss' => true,
		),
		// uncomment the following to enable URLs in path-format
		 'urlManager'=>array(
            'class'=>'ext.yii-multilanguage.MLUrlManager',
            'urlFormat'=>'path',
			'showScriptName' => false,/**/
			/// 'caseSensitive'=>false, 
            'languages'=>array(
                #...
               
                'en',
				'dk',
				'se',
				'no',
               /* 'el',
                'es',
                'fr',
                'hu',
                'ja',
                'nl',
                'pl',
                'pt',
                'ro',
                'ru',*/
                'uk',
				
                #...
            ),
            'rules'=>array(
                # ... more user rules
				
				'backend/poll/<controller:\w+>'=>'backend/poll/<controller>',
				'backend/poll/<controller:\w+>/<id:\d+>'=>'backend/poll/<controller>/<action>/<id>',
				'backend/poll/<controller:\w+>/<action:\w+>'=>'backend/poll/<controller>/<action>',
				'backend/poll/<controller:\w+>/<action:\w+>/<id:\d+>'=>'backend/poll/<controller>/<action>',
				
				'backend/user/<controller:\w+>'=>'backend/user/<controller>',
				'backend/user/<controller:\w+>/<id:\d+>'=>'backend/user/<controller>/<action>/<id>',
				'backend/user/<controller:\w+>/<action:\w+>'=>'backend/user/<controller>/<action>',
				'backend/user/<controller:\w+>/<action:\w+>/<id:\d+>'=>'backend/user/<controller>/<action>',
				
				'backend/rights/<controller:\w+>'=>'backend/rights/<controller>',
				'backend/rights/<controller:\w+>/<id:\d+>'=>'backend/rights/<controller>/<action>/<id>',
				'backend/rights/<controller:\w+>/<action:\w+>'=>'backend/rights/<controller>/<action>',
				'backend/rights/<controller:\w+>/<action:\w+>/<id:\d+>'=>'backend/rights/<controller>/<action>',
				
				'backend/translation/<controller:\w+>'=>'backend/translation/<controller>',
				'backend/translation/<controller:\w+>/<id:\d+>'=>'backend/translation/<controller>/<action>/<id>',
				'backend/translation/<controller:\w+>/<action:\w+>'=>'backend/translation/<controller>/<action>',
				'backend/translation/<controller:\w+>/<action:\w+>/<id:\d+>'=>'backend/translation/<controller>/<action>',
			
				
				'user/chat'=>'user/chat/index',
				'user/profile/usermessage'=>'user/profile/usermessage',
				'user/profile/userrfc'=>'user/profile/userrfc',
				'user/profile/userfav'=>'user/profile/userfav',
				'user/profile/import'=>'user/profile/import',
				'user/profile/right'=>'user/profile/right',
				'user/profile/useronline'=>'user/profile/useronline',
				'user/profile/generatephoto'=>'user/profile/generatephoto',
				'user/profile/removerfc'=>'user/profile/removerfc',
				'user/profile/removerfcbyid'=>'user/profile/removerfcbyid',
				'user/profile/removefav'=>'user/profile/removefav',
				'user/profile/addtofavorite'=>'user/profile/addtofavorite',
				'user/profile/acceptrequest'=>'user/profile/acceptrequest',
				'user/profile/settings'=>'user/profile/settings',
				'user/profile/updaterequest'=>'user/profile/updaterequest',
				'user/profile/index'=>'user/profile/index',
				'user/profile/search'=>'user/profile/search',
				'user/profile/edit'=>'user/profile/edit',
				'user/profile/pageload'=>'user/profile/pageload',
				'user/profile/<id:[^\/]+>'=>'user/profile/profile',
				'user/profile/updateprofiledetails'=>'user/profile/updateprofiledetails',
 			
				''=>'user/home',
				'index'=>'/user/home/home',
				'home'=>'user/profile/index',
				'message'=>'message/inbox',
				'backend'=>'backend/user/login',
				'<id:\w+>'=>'page/page/',
				
                '<controller:\w+>/<id:\d+>'=>'<controller>/view',
                '<controller:\w+>/<action:\w+>/<id:\d+>'=>'<controller>/<action>',
                '<controller:\w+>/<action:\w+>'=>'<controller>/<action>',
 
                '<module:\w+>/<controller:\w+>/<id:\d+>/<action:\w+>'=>'<module>/<controller>/<action>',
                '<module:\w+>/<controller:\w+>/<id:\d+>'=>'<module>/<controller>/view',
                '<module:\w+>/<controller:\w+>/<action:\w+>'=>'<module>/<controller>/<action>',
                '<module:\w+>/<controller:\w+>'=>'<module>/<controller>',
                '<module:\w+>'=>'<module>',
				
 
                # ...
            ),
        ),
		
		// uncomment the following to use a MySQL database
		'db'=>array(
			'connectionString' => 'mysql:host=mysql5.gigahost.dk;dbname=norvida_rajarani',
			'emulatePrepare' => true,
			'username' => 'norvida',
			'password' => 'QE73dse313',
			'charset' => 'utf8',
			'tablePrefix' => ''
		),
		'errorHandler'=>array(
			// use 'site/error' action to display errors
				'errorAction'=>'page/page/error',
		),
			'log'=>array(
			'class'=>'CLogRouter',
			/*'routes'=>array(
			array(
			'class'=>'CDbLogRoute',
			'levels'=>'info',
			'categories'=>'system.*',
			'connectionID'=>'db',
			'enabled'=>true,
			),
			// uncomment the following to show log messages on web pages
			array(
			'class'=>'CProfileLogRoute',
			'levels'=>'profile',
			'enabled'=>true,
			),
			
			),*/
			'routes'=>array(
array(
'class'=>'CFileLogRoute',
'levels'=>'error, warning',
),
// uncomment the following to show log messages on web pages
array(
'class'=>'CWebLogRoute',
'levels'=>'error, warning, trace',
),/**/
),

			),	
	/*		
		'log'=>array(
			'class'=>'CLogRouter',
			'routes'=>array(
				array(
					'class'=>'CFileLogRoute',
					'levels'=>'error, warning',
				),
				
			),
		),
	*/
	),

	'params'=>array(
		'adminEmail'=>'support@rajarani.dk',
	),
);
//===================
$lam_config['sourceLanguage'] = 'en'; // the language that application was written in
$lo_session=new CHttpSession;
$lo_session->open();
$lam_config['language'] = $session["lang"];
return $lam_config;
