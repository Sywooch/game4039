<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/3/2
 * Time: 10:49
 * Desc:
 */

namespace frontend\controllers\user;

use yii\web\NotFoundHttpException;
use Yii;
use frontend\models\RegistrationForm;


class RegistrationController extends \dektrium\user\controllers\RegistrationController
{
	/**
	 * Displays the registration page.
	 * After successful registration if enableConfirmation is enabled shows info message otherwise redirects to home page.
	 *
	 * @return string
	 * @throws \yii\web\HttpException
	 */
	public function actionRegister()
	{
		if (!$this->module->enableRegistration) {
			throw new NotFoundHttpException();
		}

		/** @var RegistrationForm $model */
		$model = Yii::createObject(RegistrationForm::className());

		$this->performAjaxValidation($model);

		if ($model->load(Yii::$app->request->post()) && $model->register()) {
			return $this->render('/message', [
				'title'  => Yii::t('user', 'Your account has been created'),
				'module' => $this->module,
			]);
		}

		return $this->render('register', [
			'model'  => $model,
			'module' => $this->module,
		]);
	}

}