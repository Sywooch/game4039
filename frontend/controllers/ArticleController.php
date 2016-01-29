<?php

namespace frontend\controllers;

use common\models\Article;
use common\models\ArticleAttachment;
use frontend\models\search\ArticleSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class ArticleController extends Controller
{

	/**
	 * @return string
	 */
	public function actionIndex()
	{
		$searchModel = new ArticleSearch();
		$dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
		$dataProvider->sort = [
			'defaultOrder' => ['created_at' => SORT_DESC]
		];
		$dataProvider->pagination = [
			'pageSize' => '2	',
		];
		return $this->render('index', ['dataProvider' => $dataProvider]);
	}

	/**
	 * @param $slug
	 * @return string
	 * @throws NotFoundHttpException
	 */
	public function actionView($slug)
	{
		$model = Article::find()->published()->andWhere(['slug' => $slug])->one();
		if (!$model)
		{
			throw new NotFoundHttpException;
		}

		$viewFile = $model->view ?: 'view';
		return $this->render($viewFile, ['model' => $model]);
	}

	public function actionAttachmentDownload($id)
	{
		$model = ArticleAttachment::findOne($id);
		if (!$model)
		{
			throw new NotFoundHttpException;
		}

		return \Yii::$app->response->sendStreamAsFile(
			\Yii::$app->fileStorage->getFilesystem()->readStream($model->path),
			$model->name
		);
	}

	/*
	 * ajax add click
	 * */
	public function actionAddClick($id)
	{
		if(\Yii::$app->request->isAjax){
			$model = Article::findOne($id);
			$model->actionAddClick();
			return json_encode(1);
		}
	}

	/*
	 * ajax add stars
	 * */
	public function actionAddStars($id)
	{
		if(\Yii::$app->request->isAjax){
			$model = Article::findOne($id);
			$model->addStars();
			return json_encode(1);
		}
	}
}
