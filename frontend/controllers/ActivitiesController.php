<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/12/29
 * Time: 14:26
 * Desc: 活动控制器
 */

namespace frontend\controllers;


use common\models\Activity;
use frontend\models\search\ActivitySearch;
use yii\web\NotFoundHttpException;
use yii\web\Controller;
use Yii;

class ActivitiesController extends Controller
{

	public function actionIndex()
	{
		$searchModel = new ActivitySearch();
		$dataProvider = $searchModel->search(Yii::$app->request->queryParams);
		$dataProvider->sort = [
			'defaultOrder' => ['updated_at' => SORT_DESC,'end_time'=>SORT_DESC]
		];
		return $this->render('index', [
			'dataProvider' => $dataProvider,
		]);
	}

	public function actionView($slug){
		$this->layout='singlepage';
		$model=Activity::findOne(['slug'=>$slug]);
		if(!$model){
			throw new NotFoundHttpException;
		}
		return $this->render('view',[
			'model' => $model,
		]);

	}

}