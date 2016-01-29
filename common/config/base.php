<?php
$config = [
	'name' => '4039页游平台',
	'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
	'extensions' => require(__DIR__ . '/../../vendor/yiisoft/extensions.php'),
	'sourceLanguage' => 'en-US',
	'language' => 'zh-CN',
	'timeZone' => 'Asia/Shanghai',
	'bootstrap' => ['log'],
	'modules' => [
		'gridview' =>  [
			'class' => '\kartik\grid\Module'
		],
	],
	'components' => [

		'authManager' => [
			'class' => 'yii\rbac\DbManager',
			'itemTable' => '{{%rbac_auth_item}}',
			'itemChildTable' => '{{%rbac_auth_item_child}}',
			'assignmentTable' => '{{%rbac_auth_assignment}}',
			'ruleTable' => '{{%rbac_auth_rule}}'
		],

		'cache' => [
			'class' => 'yii\caching\FileCache',
			'cachePath' => '@common/runtime/cache'
		],

		'commandBus' => [
			'class' => '\trntv\tactician\Tactician',
			'commandNameExtractor' => '\League\Tactician\Handler\CommandNameExtractor\ClassNameExtractor',
			'methodNameInflector' => '\League\Tactician\Handler\MethodNameInflector\HandleInflector',
			'commandToHandlerMap' => [
				'common\commands\command\SendEmailCommand' => '\common\commands\handler\SendEmailHandler',
				'common\commands\command\AddToTimelineCommand' => '\common\commands\handler\AddToTimelineHandler',
			]
		],

		'formatter' => [
			'class' => 'yii\i18n\Formatter',
			'dateFormat' => 'yyyy-MM-dd',
			'datetimeFormat' => 'yyyy-MM-dd HH:mm',
			'decimalSeparator' => ',',
			'thousandSeparator' => ' ',
			'currencyCode' => 'RMB',
		],

		'glide' => [
			'class' => 'trntv\glide\components\Glide',
			'sourcePath' => '@storage/web/source',
			'cachePath' => '@storage/cache',
			'urlManager' => 'urlManagerStorage',
			'maxImageSize' => getenv('GLIDE_MAX_IMAGE_SIZE'),
			'signKey' => getenv('GLIDE_SIGN_KEY')
		],

		/*'mailer' => [
			'class' => 'yii\swiftmailer\Mailer',
			'useFileTransport' => YII_ENV_DEV,
			'messageConfig' => [
				'charset' => 'UTF-8',
				'from' => getenv('ADMIN_EMAIL')
			]
		],*/
		'mailer' => [
			'class' => 'yii\swiftmailer\Mailer',
			//'viewPath' => '@common/mail',
			'useFileTransport' => false,
			'transport' => [
				'class' => 'Swift_SmtpTransport',
				'host' => getenv('MAIL_HOST'),
				'username' => getenv('MAIL_USERNAME'),
				'password' => getenv('MAIL_PASSWORD'),
				'port' => getenv('MAIL_PORT'),
				'encryption' => 'tls',
			],
			'messageConfig' => [
				//'charset'=>'UTF-8',
				//'from'=>['304154554@qq.com'=>'admin']
			]
		],

		'db' => [
			'class' => 'yii\db\Connection',
			'dsn' => getenv('DB_DSN'),
			'username' => getenv('DB_USERNAME'),
			'password' => getenv('DB_PASSWORD'),
			'tablePrefix' => getenv('DB_TABLE_PREFIX'),
			'charset' => 'utf8',
			'enableSchemaCache' => YII_ENV_PROD,
		],
		'dzdb' => [
			//discuz db
			'class' => 'yii\db\Connection',
			'dsn' => getenv('DB_DISCUZ_DSN'),
			'username' => getenv('DB_DISCUZ_USERNAME'),
			'password' => getenv('DB_DISCUZ_PASSWORD'),
			'charset' => 'utf8',
			'tablePrefix' => getenv('DB_DISCUZ_TABLE_PREFIX'),
		],

		'log' => [
			'traceLevel' => YII_DEBUG ? 3 : 0,
			'targets' => [
				'db' => [
					'class' => 'yii\log\DbTarget',
					'levels' => ['error', 'warning'],
					'except' => ['yii\web\HttpException:*', 'yii\i18n\I18N\*'],
					'prefix' => function ()
					{
						$url = !Yii::$app->request->isConsoleRequest ? Yii::$app->request->getUrl() : null;
						return sprintf('[%s][%s]', Yii::$app->id, $url);
					},
					'logVars' => [],
					'logTable' => '{{%system_log}}'
				]
			],
		],

		'i18n' => [
			'translations' => [
				'app' => [
					'class' => 'yii\i18n\PhpMessageSource',
					'basePath' => '@common/messages',
				],
				'*' => [
					'class' => 'yii\i18n\PhpMessageSource',
					'basePath' => '@common/messages',
					'fileMap' => [
						'common' => 'common.php',
						'backend' => 'backend.php',
						'frontend' => 'frontend.php',
					],
					'on missingTranslation' => ['\backend\modules\i18n\Module', 'missingTranslation']
				],
				/* Uncomment this code to use DbMessageSource
				 '*'=> [
					'class' => 'yii\i18n\DbMessageSource',
					'sourceMessageTable'=>'{{%i18n_source_message}}',
					'messageTable'=>'{{%i18n_message}}',
					'enableCaching' => YII_ENV_DEV,
					'cachingDuration' => 3600,
					'on missingTranslation' => ['\backend\modules\i18n\Module', 'missingTranslation']
				],
				*/
			],
		],

		'fileStorage' => [
			'class' => '\trntv\filekit\Storage',
			'baseUrl' => '@storageUrl/source',
			'filesystem' => [
				'class' => 'common\components\filesystem\LocalFlysystemBuilder',
				'path' => '@storage/web/source'
			],
			'as log' => [
				'class' => 'common\behaviors\FileStorageLogBehavior',
				'component' => 'fileStorage'
			]
		],

		'keyStorage' => [
			'class' => 'common\components\keyStorage\KeyStorage'
		],

		'urlManagerBackend' => \yii\helpers\ArrayHelper::merge(
			[
				'hostInfo' => Yii::getAlias('@backendUrl')
			],
			require(Yii::getAlias('@backend/config/_urlManager.php'))
		),
		'urlManagerFrontend' => \yii\helpers\ArrayHelper::merge(
			[
				'hostInfo' => Yii::getAlias('@frontendUrl')
			],
			require(Yii::getAlias('@frontend/config/_urlManager.php'))
		),
		'urlManagerStorage' => \yii\helpers\ArrayHelper::merge(
			[
				'hostInfo' => Yii::getAlias('@storageUrl')
			],
			require(Yii::getAlias('@storage/config/_urlManager.php'))
		),

		//my new add component
		'cart' => [
			'class' => 'yz\shoppingcart\ShoppingCart',
			'cartId' => 'my_application_cart',
		]
	],
	'params' => [
		'adminEmail' => getenv('ADMIN_EMAIL'),
		'robotEmail' => getenv('ROBOT_EMAIL'),
		'availableLocales' => [
			'en-US' => 'English (US)',
			'zh-CN' => '中文(CN)'
		],
	],
];

if (YII_ENV_PROD)
{
	$config['components']['log']['targets']['email'] = [
		'class' => 'yii\log\EmailTarget',
		'except' => ['yii\web\HttpException:*'],
		'levels' => ['error', 'warning'],
		'message' => ['from' => getenv('ROBOT_EMAIL'), 'to' => getenv('ADMIN_EMAIL')]
	];
}

if (YII_ENV_DEV)
{
	$config['bootstrap'][] = 'gii';
	$config['modules']['gii'] = [
		'class' => 'yii\gii\Module'
	];

	$config['components']['cache'] = [
		'class' => 'yii\caching\DummyCache'
	];
}

return $config;
