<?php

namespace backend\controllers;

use backend\models\KefuSelfServiceCheckForm;
use common\models\KefuSelfserviceCat;
use dektrium\user\models\User;
use Yii;
use common\models\KefuSelfservice;
use backend\models\search\KefuSelfserviceSearch;
use yii\helpers\ArrayHelper;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KefuSelfserviceController implements the CRUD actions for KefuSelfservice model.
 */
class KefuSelfserviceController extends Controller
{

	public function behaviors()
	{
		return [
			'verbs' => [
				'class' => VerbFilter::className(),
				'actions' => [
					'delete' => ['post'],
				],
			],
		];
	}

	/**
	 * Lists all KefuSelfservice models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new KefuSelfserviceSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single KefuSelfservice model.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionView($id)
	{
		return $this->render('view', [
			'model' => $this->findModel($id),
		]);
	}

	/**
	 * Creates a new KefuSelfservice model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new KefuSelfservice();
		$categories = KefuSelfserviceCat::find()->all();
		if ($model->load(Yii::$app->request->post()) && $model->save())
		{
			return $this->redirect(['view', 'id' => $model->id]);
		} else
		{
			return $this->render('create', [
				'model' => $model,
				'categories' => $categories,
			]);
		}
	}

	/**
	 * Updates an existing KefuSelfservice model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);
		$categories = KefuSelfserviceCat::find()->all();
		if ($model->load(Yii::$app->request->post()) && $model->save())
		{
			return $this->redirect(['view', 'id' => $model->id]);
		} else
		{
			return $this->render('update', [
				'model' => $model,
				'categories' => $categories,
			]);
		}
	}

	/**
	 * Deletes an existing KefuSelfservice model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();
		return $this->redirect(['index']);
	}

	public function actionResult($id)
	{
		$model = $this->findModel($id);

		$modelCheckForm = new KefuSelfServiceCheckForm();
		$modelCheckForm->_id = $id;
		$modelCheckForm->result = $model->result;
		$modelCheckForm->status = $model->status;
		if ($modelCheckForm->load(Yii::$app->request->post()) && $modelCheckForm->save())
		{
			return $this->redirect(['view', 'id' => $id]);
		}
		return $this->render('check', [
			'model' => $model,
			'modelCheckForm' => $modelCheckForm,
		]);

	}

	/**
	 * Finds the KefuSelfservice model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return KefuSelfservice the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = KefuSelfservice::findOne($id)) !== null)
		{
			return $model;
		} else
		{
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
