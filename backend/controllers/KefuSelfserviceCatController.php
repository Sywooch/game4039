<?php

namespace backend\controllers;

use Yii;
use common\models\KefuSelfserviceCat;
use backend\models\search\KefuSelfserviceCatSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KefuSelfserviceCatController implements the CRUD actions for KefuSelfserviceCat model.
 */
class KefuSelfserviceCatController extends Controller
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
	 * Lists all KefuSelfserviceCat models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new KefuSelfserviceCatSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single KefuSelfserviceCat model.
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
	 * Creates a new KefuSelfserviceCat model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new KefuSelfserviceCat();
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
	 * Updates an existing KefuSelfserviceCat model.
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
	 * Deletes an existing KefuSelfserviceCat model.
	 * If deletion is successful, the browser will be redirected to the 'index' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionDelete($id)
	{
		$this->findModel($id)->delete();

		return $this->redirect(['index']);
	}

	/**
	 * Finds the KefuSelfserviceCat model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return KefuSelfserviceCat the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = KefuSelfserviceCat::findOne($id)) !== null)
		{
			return $model;
		} else
		{
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
