<?php
$config = [
	'components' => [
		'assetManager' => [
			'class' => 'yii\web\AssetManager',
			'linkAssets' => true,
			'appendTimestamp' => YII_ENV_DEV,
			'bundles' => [
				'yii\web\JqueryAsset' => [
					'js' => [
						YII_ENV_DEV ? 'jquery.js' : 'jquery.min.js'
					]
				],
				'yii\bootstrap\BootstrapAsset' => [
					'css' => [
						YII_ENV_DEV ? 'css/bootstrap.css' : 'css/bootstrap.min.css'
					]
				],
				'yii\bootstrap\BootstrapPluginAsset' => [
					'js' => [
						YII_ENV_DEV ? 'js/bootstrap.js' : 'js/bootstrap.min.js'
					]
				],
			],
			'assetMap' => [
			],
		]
	],
	/*'as locale' => [
		'class' => 'common\behaviors\LocaleBehavior',
		'enablePreferredLanguage' => true
	]*/
];

if (YII_DEBUG)
{
	$config['bootstrap'][] = 'debug';
	$config['modules']['debug'] = [
		'class' => 'yii\debug\Module',
		'allowedIPs' => ['127.0.0.1', '::1', '192.168.33.1', '172.17.42.1'],
	];
}

if (YII_ENV_DEV)
{
	$config['modules']['gii'] = [
		'allowedIPs' => ['127.0.0.1', '::1', '192.168.33.1', '172.17.42.1'],
	];
}


return $config;
