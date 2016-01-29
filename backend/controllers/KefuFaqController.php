<?php

namespace backend\controllers;

use common\models\KefuFaqCat;
use Yii;
use common\models\KefuFaq;
use backend\models\search\KefuFaqSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KefuFaqController implements the CRUD actions for KefuFaq model.
 */
class KefuFaqController extends Controller
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
	 * Lists all KefuFaq models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new KefuFaqSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single KefuFaq model.
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
	 * Creates a new KefuFaq model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new KefuFaq();
		$categories = KefuFaqCat::find()->all();

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
	 * Updates an existing KefuFaq model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);
		$categories = KefuFaqCat::find()->all();

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
	 * Deletes an existing KefuFaq model.
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
	 * Finds the KefuFaq model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return KefuFaq the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = KefuFaq::findOne($id)) !== null)
		{
			return $model;
		} else
		{
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
