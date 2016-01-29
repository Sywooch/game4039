<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/12/16
 * Time: 14:08
 * Desc:
 */

namespace backend\controllers;

use backend\models\search\AdminLoginLogSearch;
use backend\models\search\AdminLogSearch;
use backend\models\search\UserLoginLogSearch;
use backend\models\search\UserLogSearch;
use common\models\AdminLog;
use common\models\AdminLoginLog;
use common\models\UserLog;
use common\models\UserLoginLog;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use yii\web\Controller;
use Yii;

class UserLogsController extends Controller
{

	/*
	 * list all AdminLoginLog models
	 * */
	public function actionAdminLoginLog()
	{
		$searchModel = new AdminLoginLogSearch();
		$dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

		if (strcasecmp(Yii::$app->request->method, 'delete') == 0)
		{
			AdminLoginLog::deleteAll($dataProvider->query->where);
			return $this->refresh();
		}
		$dataProvider->sort = [
			'defaultOrder' => ['login_time' => SORT_DESC]
		];

		return $this->render('admin-login-log', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	/*
	 * delete an existing AdminLoginLog model by id
	 * */
	public function actionDeleteAdminLoginLog($id)
	{
		$this->findAminLoginLogModel($id)->delete();
		return $this->redirect(['admin-login-log']);
	}

	/*
	 * find AdminLoginLog model by id
	 * */
	protected function findAminLoginLogModel($id)
	{
		if (($model = AdminLoginLog::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
	/******************************************************************************************************************/

	/*
	 * admin opration logs
	 * */
	public function actionAdminLog(){
		$searchModel=new AdminLogSearch();
		$dataProvider=$searchModel->search(Yii::$app->request->queryParams);
		if (strcasecmp(Yii::$app->request->method, 'delete') == 0)
		{
			AdminLog::deleteAll($dataProvider->query->where);
			return $this->refresh();
		}

		$dataProvider->sort = [
			'defaultOrder' => ['log_time' => SORT_DESC]
		];

		return $this->render('admin-log', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	/*
	 * delete an existing AdminLog model by id
	 * */
	public function actionDeleteAdminLog($id)
	{
		$this->findAminLogModel($id)->delete();
		return $this->redirect(['admin-log']);
	}

	/*
	 * find AdminLog model by id
	 * */
	protected function findAminLogModel($id)
	{
		if (($model = AdminLog::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}


	/******************************************************************************************************************/

	/*
	 * list all UserLoginLog models
	 * */
	public function actionUserLoginLog()
	{
		$searchModel = new UserLoginLogSearch();
		$dataProvider = $searchModel->search(\Yii::$app->request->queryParams);

		if (strcasecmp(Yii::$app->request->method, 'delete') == 0)
		{
			UserLoginLog::deleteAll($dataProvider->query->where);
			return $this->refresh();
		}
		$dataProvider->sort = [
			'defaultOrder' => ['login_time' => SORT_DESC]
		];
		return $this->render('user-login-log', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	/*
	 * delete an existing UserLoginLog model by id
	 * */
	public function actionDeleteUserLoginLog($id)
	{
		$this->findUserLoginLogModel($id)->delete();
		return $this->redirect(['admin-login-log']);
	}

	/*
	 * find UserLoginLog model by id
	 * */
	protected function findUserLoginLogModel($id)
	{
		if (($model = UserLoginLog::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}

	/******************************************************************************************************************/

	/*
	 * admin opration logs
	 * */
	public function actionUserLog(){
		$searchModel=new UserLogSearch();
		$dataProvider=$searchModel->search(Yii::$app->request->queryParams);
		if (strcasecmp(Yii::$app->request->method, 'delete') == 0)
		{
			AdminLog::deleteAll($dataProvider->query->where);
			return $this->refresh();
		}

		$dataProvider->sort = [
			'defaultOrder' => ['log_time' => SORT_DESC]
		];

		return $this->render('user-log', [
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

	/*
	 * delete an existing AdminLog model by id
	 * */
	public function actionDeleteUserLog($id)
	{
		$this->findUserLogModel($id)->delete();
		return $this->redirect(['admin-log']);
	}

	/*
	 * find AdminLog model by id
	 * */
	protected function findUserLogModel($id)
	{
		if (($model = UserLog::findOne($id)) !== null) {
			return $model;
		} else {
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}


