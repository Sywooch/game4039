<?php

namespace backend\controllers;

use Yii;
use common\models\KefuAccountRepair;
use backend\models\search\KefuAccountRepairSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KefuAccountRepairController implements the CRUD actions for KefuAccountRepair model.
 */
class KefuAccountRepairController extends Controller
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
	 * Lists all KefuAccountRepair models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new KefuAccountRepairSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->sort = [
			'defaultOrder' => [
				'created_at'=>SORT_DESC
			],
		];

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single KefuAccountRepair model.
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
	 * Creates a new KefuAccountRepair model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new KefuAccountRepair();

		if ($model->load(Yii::$app->request->post()) && $model->save())
		{
			return $this->redirect(['view', 'id' => $model->id]);
		} else
		{
			return $this->render('create', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Updates an existing KefuAccountRepair model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);

		if ($model->load(Yii::$app->request->post()) && $model->save())
		{
			return $this->redirect(['view', 'id' => $model->id]);
		} else
		{
			return $this->render('update', [
				'model' => $model,
			]);
		}
	}

	/**
	 * Deletes an existing KefuAccountRepair model.
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
	 * Finds the KefuAccountRepair model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return KefuAccountRepair the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = KefuAccountRepair::findOne($id)) !== null)
		{
			return $model;
		} else
		{
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
