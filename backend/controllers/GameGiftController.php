<?php

namespace backend\controllers;

use common\models\GameServer;
use Yii;
use common\models\GameGift;
use backend\models\search\GameGiftSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * GameGiftController implements the CRUD actions for GameGift model.
 */
class GameGiftController extends Controller
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
	 * Lists all GameGift models.
	 * @return mixed
	 */
	public function actionIndex()
	{
		$searchModel = new GameGiftSearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * Displays a single GameGift model.
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
	 * Creates a new GameGift model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 * @return mixed
	 */
	public function actionCreate()
	{
		$model = new GameGift();
		$servers = GameServer::find()->all();
		if ($model->load(Yii::$app->request->post()) && $model->save())
		{
			return $this->redirect(['view', 'id' => $model->id]);
		} else
		{
			return $this->render('create', [
				'model' => $model,
				'servers' => $servers,
			]);
		}
	}

	/**
	 * Updates an existing GameGift model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id
	 * @return mixed
	 */
	public function actionUpdate($id)
	{
		$model = $this->findModel($id);
		$servers = GameServer::find()->all();

		if ($model->load(Yii::$app->request->post()) && $model->save())
		{
			return $this->redirect(['view', 'id' => $model->id]);
		} else
		{
			return $this->render('update', [
				'model' => $model,
				'servers' => $servers,
			]);
		}
	}

	/**
	 * Deletes an existing GameGift model.
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
	 * Finds the GameGift model based on its primary key value.
	 * If the model is not found, a 404 HTTP exception will be thrown.
	 * @param integer $id
	 * @return GameGift the loaded model
	 * @throws NotFoundHttpException if the model cannot be found
	 */
	protected function findModel($id)
	{
		if (($model = GameGift::findOne($id)) !== null)
		{
			return $model;
		} else
		{
			throw new NotFoundHttpException('The requested page does not exist.');
		}
	}
}
