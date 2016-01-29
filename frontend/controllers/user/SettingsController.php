<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/12/23
 * Time: 19:01
 * Desc:
 */

namespace frontend\controllers\user;

use common\base\MultiModel;
use frontend\models\UserSecurityQuestionsForm;
use Yii;
use dektrium\user\models\SettingsForm;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\NotFoundHttpException;
use dektrium\user\Module;


class SettingsController extends \dektrium\user\controllers\SettingsController
{

	/** @inheritdoc */
	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'disconnect' => ['post'],
				],
			],
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					[
						'allow' => true,
						'actions' => ['index', 'security-settings', 'name-auth', 'security-questions', 'profile', 'account', 'confirm', 'networks', 'disconnect'],
						'roles' => ['@'],
					],
				],
			],
		];
	}

	public function actionIndex()
	{
		/*$profile = $this->finder->findProfileById(Yii::$app->user->identity->getId());
		$account = Yii::createObject(SettingsForm::className());

		$this->performAjaxValidation($profile);
		$this->performAjaxValidation($account);

		$model = new MultiModel([
			'models' => [
				'profile' => $profile,
				'account' => $account,
			],
		]);
		return $this->render('index', [
			'model' => $model,
		]);*/

		return $this->redirect(['profile']);
	}

	/**
	 * Shows profile settings form.
	 *
	 * @return string|\yii\web\Response
	 */
	public function actionProfile()
	{
		$model = $this->finder->findProfileById(Yii::$app->user->identity->getId());

		$this->performAjaxValidation($model);

		if ($model->load(Yii::$app->request->post()) && $model->save())
		{
			Yii::$app->getSession()->setFlash('success', Yii::t('user', 'Your profile has been updated'));

			return $this->refresh();
		}
		return $this->render('profile', [
			'model' => $model,
		]);
	}

	/**
	 * Displays page where user can update account settings (username, email or password).
	 *
	 * @return string|\yii\web\Response
	 */
	public function actionAccount()
	{
		/** @var SettingsForm $model */
		$model = Yii::createObject(SettingsForm::className());

		$this->performAjaxValidation($model);

		if ($model->load(Yii::$app->request->post()) && $model->save())
		{
			Yii::$app->session->setFlash('success', Yii::t('user', '你账号的账号已经被成功更新!'));

			return $this->refresh();
			//return $this->redirect('security-settings');
		}
		//Yii::$app->getSession()->setFlash('success', Yii::t('user', '不能验证你输入的信息!'));
		return $this->redirect('security-settings');
	}

	/**
	 * Attempts changing user's password.
	 *
	 * @param int $id
	 * @param string $code
	 *
	 * @return string
	 * @throws \yii\web\HttpException
	 */
	public function actionConfirm($id, $code)
	{
		$user = $this->finder->findUserById($id);

		if ($user === null || $this->module->emailChangeStrategy == Module::STRATEGY_INSECURE)
		{
			throw new NotFoundHttpException();
		}

		$user->attemptEmailChange($code);

		return $this->redirect(['index']);
	}

	public function actionNameAuth()
	{
		$model = $this->finder->findProfileById(Yii::$app->user->identity->getId());

		$this->performAjaxValidation($model);

		if ($model->load(Yii::$app->request->post()) && $model->save())
		{
			Yii::$app->getSession()->setFlash('success', Yii::t('user', '你的实名信息已经被成功设置'));

			return $this->refresh();
		}
		return $this->redirect('security-settings');
	}

	public function actionSecurityQuestions()
	{
		$model = new UserSecurityQuestionsForm();
		$this->performAjaxValidation($model);
		if ($model->load(Yii::$app->request->post()) && $model->save())
		{
			Yii::$app->getSession()->setFlash('success', '您的密保设置成功!');
			return $this->refresh();
		}
		return $this->redirect('security-settings');
	}


	public function actionSecuritySettings()
	{
		$account = Yii::createObject(SettingsForm::className());

		$nameAuth = $this->finder->findProfileById(Yii::$app->user->identity->getId());

		$securityQuestions = new UserSecurityQuestionsForm();

		$model = new MultiModel([
			'models' => [
				'account' => $account,
				'nameAuth' => $nameAuth,
				'securityQuestions' => $securityQuestions,
			],
		]);
		return $this->render('security-settings', [
			'model' => $model,
		]);
	}
}