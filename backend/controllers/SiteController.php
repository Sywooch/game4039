<?php
namespace backend\controllers;

use common\components\keyStorage\FormModel;
use Yii;

/**
 * Site controller
 */
class SiteController extends \yii\web\Controller
{

	/**
	 * @inheritdoc
	 */
	public function actions()
	{
		return [
			'error' => [
				'class' => 'yii\web\ErrorAction',
			]
		];
	}

	public function beforeAction($action)
	{
		$this->layout = Yii::$app->user->isGuest || !Yii::$app->user->can('loginToBackend') ? 'base' : 'common';
		return parent::beforeAction($action);
	}

	public function actionSettings()
	{
		$model = new FormModel([
			'keys' => [
				'frontend.maintenance' => [
					'label' => Yii::t('backend', 'Frontend maintenance mode'),
					'type' => FormModel::TYPE_DROPDOWN,
					'items' => [
						'disabled' => Yii::t('backend', 'Disabled'),
						'enabled' => Yii::t('backend', 'Enabled')
					]
				],
				'backend.theme-skin' => [
					'label' => Yii::t('backend', 'Backend theme'),
					'type' => FormModel::TYPE_DROPDOWN,
					'items' => [
						'skin-black' => 'skin-black',
						'skin-blue' => 'skin-blue',
						'skin-green' => 'skin-green',
						'skin-purple' => 'skin-purple',
						'skin-red' => 'skin-red',
						'skin-yellow' => 'skin-yellow'
					]
				],
				'backend.layout-fixed' => [
					'label' => Yii::t('backend', 'Fixed backend layout'),
					'type' => FormModel::TYPE_CHECKBOX
				],
				'backend.layout-boxed' => [
					'label' => Yii::t('backend', 'Boxed backend layout'),
					'type' => FormModel::TYPE_CHECKBOX
				],
				'backend.layout-collapsed-sidebar' => [
					'label' => Yii::t('backend', 'Backend sidebar collapsed'),
					'type' => FormModel::TYPE_CHECKBOX
				]
			]
		]);

		if ($model->load(Yii::$app->request->post()) && $model->save())
		{
			Yii::$app->session->setFlash('alert', [
				'body' => Yii::t('backend', 'Settings was successfully saved'),
				'options' => ['class' => 'alert alert-success']
			]);
			return $this->refresh();
		}

		return $this->render('settings', ['model' => $model]);
	}


	/*
	 * SEO settings
	 * */
	public function actionSeoSettings()
	{
		$model = new FormModel([
			'keys' => [
				'seo_title' => [
					'label' => Yii::t('common', 'SEO Title'),
					'type' => FormModel::TYPE_TEXTAREA
				],
				'seo_keywords' => [
					'label' => Yii::t('common', 'SEO Keywords'),
					'type' => FormModel::TYPE_TEXTAREA,
				],
				'seo_description' => [
					'label' => Yii::t('common', 'SEO Description'),
					'type' => FormModel::TYPE_TEXTAREA,
				],
			]
		]);

		if ($model->load(Yii::$app->request->post()) && $model->save())
		{
			Yii::$app->session->setFlash('alert', [
				'body' => Yii::t('backend', 'Settings was successfully saved'),
				'options' => ['class' => 'alert alert-success']
			]);
			return $this->refresh();
		}

		return $this->render('seo-settings', ['model' => $model]);
	}

	/*
	 * Email Settings
	 * */
	public function actionMailSettings()
	{
		$model = new FormModel([
			'keys' => [
				'mail_host' => [
					'label' => Yii::t('common', 'Mail Host'),
					'type' => FormModel::TYPE_TEXTINPUT
				],
				'mail_port' => [
					'label' => Yii::t('common', 'Mail Port'),
					'type' => FormModel::TYPE_TEXTINPUT,
				],
				'mail_username' => [
					'label' => Yii::t('common', 'Mail Username'),
					'type' => FormModel::TYPE_TEXTINPUT,
				],
				'mail_password' => [
					'label' => Yii::t('common', 'Mail Password'),
					'type' => FormModel::TYPE_TEXTINPUT,
				],
				'mail_support' => [
					'label' => Yii::t('common', 'Mail Support'),
					'type' => FormModel::TYPE_TEXTINPUT,
				],
				'mail_admin_account' => [
					'label' => Yii::t('common', 'Mail Admin Account'),
					'type' => FormModel::TYPE_TEXTINPUT,
				],
			]
		]);
		if ($model->load(Yii::$app->request->post()) && $model->save())
		{
			Yii::$app->session->setFlash('alert', [
				'body' => Yii::t('backend', 'Settings was successfully saved'),
				'options' => ['class' => 'alert alert-success']
			]);
			return $this->refresh();
		}
		return $this->render('mail-settings', ['model' => $model]);
	}

	/*
	 * Basic web settings
	 * */
	public function actionBasicSettings()
	{
		$model = new FormModel([
			'keys' => [
				'site_name' => [
					'label' => Yii::t('common', 'Site Name'),
					'type' => FormModel::TYPE_TEXTINPUT
				],
				'site_name_fu' => [
					'label' => Yii::t('common', 'Site Name Fu'),
					'type' => FormModel::TYPE_TEXTINPUT,
				],
				'backend_name' => [
					'label' => Yii::t('common', 'Backend Name'),
					'type' => FormModel::TYPE_TEXTINPUT
				],
				'site_description' => [
					'label' => Yii::t('common', 'Site Description'),
					'type' => FormModel::TYPE_TEXTAREA,
				],
				'site_phone' => [
					'label' => Yii::t('common', 'Site Phone'),
					'type' => FormModel::TYPE_TEXTINPUT,
				],
				'site_address' => [
					'label' => Yii::t('common', 'Site Address'),
					'type' => FormModel::TYPE_TEXTINPUT,
				],
				'site_ip' => [
					'label' => Yii::t('common', 'Site IP'),
					'type' => FormModel::TYPE_TEXTINPUT,
				],

				'site_domain' => [
					'label' => Yii::t('common', 'Site Domain'),
					'type' => FormModel::TYPE_TEXTINPUT,
				],
				'register_nums' => [
					'label' => Yii::t('common', 'Register Nums'),
					'type' => FormModel::TYPE_TEXTINPUT,
				],
				'keywords' => [
					'label' => Yii::t('common', 'Keywords'),
					'type' => FormModel::TYPE_TEXTAREA,
				],
				'bei_an' => [
					'label' => Yii::t('common', 'Bei An'),
					'type' => FormModel::TYPE_TEXTAREA,
				],
				'wen_wang_wen' => [
					'label' => Yii::t('common', 'Wen Wang Wen'),
					'type' => FormModel::TYPE_TEXTINPUT,
				],
				'zeng_zhi' => [
					'label' => Yii::t('common', 'Zeng Zhi'),
					'type' => FormModel::TYPE_TEXTINPUT,
				],
				'app_id' => [
					'label' => Yii::t('common', 'App ID'),
					'type' => FormModel::TYPE_TEXTINPUT,
				],

				'app_key' => [
					'label' => Yii::t('common', 'App Key'),
					'type' => FormModel::TYPE_TEXTINPUT,
				],
				'uc_api' => [
					'label' => Yii::t('common', 'UC API'),
					'type' => FormModel::TYPE_TEXTINPUT,
				],
				'uc_key' => [
					'label' => Yii::t('common', 'UC Key'),
					'type' => FormModel::TYPE_TEXTINPUT,
				],
				'uc_password' => [
					'label' => Yii::t('common', 'UC Password'),
					'type' => FormModel::TYPE_TEXTINPUT,
				],
			]
		]);
		if ($model->load(Yii::$app->request->post()) && $model->save())
		{
			Yii::$app->session->setFlash('alert', [
				'body' => Yii::t('backend', 'Settings was successfully saved'),
				'options' => ['class' => 'alert alert-success']
			]);
			return $this->refresh();
		}
		return $this->render('basic-settings', ['model' => $model]);
	}


	/*
	 * Email Settings
	 * */
	public function actionOthersSettings()
	{
		$model = new FormModel([
			'keys' => [
				'bei_an_url' => [
					'label' => Yii::t('common', 'Bei An URL'),
					'type' => FormModel::TYPE_TEXTINPUT
				],
				'wen_wang_wen_url' => [
					'label' => Yii::t('common', 'Wen Wang Wen URL'),
					'type' => FormModel::TYPE_TEXTINPUT,
				],
				'authentication_alliance_URL' => [
					'label' => Yii::t('common', 'Authentication Alliance URL'),
					'type' => FormModel::TYPE_TEXTINPUT,
				],
				'adverse_information_report_url' => [
					'label' => Yii::t('common', 'Adverse Information Report URL'),
					'type' => FormModel::TYPE_TEXTINPUT,
				],
			]
		]);
		if ($model->load(Yii::$app->request->post()) && $model->save())
		{
			Yii::$app->session->setFlash('alert', [
				'body' => Yii::t('backend', 'Settings was successfully saved'),
				'options' => ['class' => 'alert alert-success']
			]);
			return $this->refresh();
		}
		return $this->render('others-settings', ['model' => $model]);
	}
}
