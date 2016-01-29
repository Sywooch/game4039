<?php

namespace backend\controllers;

use Yii;
use common\models\KefuFaqCat;
use backend\models\search\KefuFaqCatSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * KefuFaqCatController implements the CRUD actions for KefuFaqCat model.
 */
class KefuFaqCatController extends Controller
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
	 * Lists all KefuFaqCat models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new KefuFaqCatSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single KefuFaqCat model.
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
	 * Creates a new KefuFaqCat model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new KefuFaqCat();
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
	 * Updates an existing KefuFaqCat model.
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
	 * Deletes an existing KefuFaqCat model.
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
	 * Finds the KefuFaqCat model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return KefuFaqCat the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = KefuFaqCat::findOne($id)) !== null)
		{
			return $model;
		} else
		{
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
