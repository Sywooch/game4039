<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/3/17
 * Time: 9:29
 * Desc:
 */

namespace backend\controllers;


use backend\models\search\FrontendUserSearch;
use dektrium\user\Finder;
use yii\web\Controller;

class FrontendUserController extends Controller
{

	public function actionIndex(){
		$finder=new Finder();
		$searchModel=new FrontendUserSearch($finder);
		$dataProvider=$searchModel->search(\Yii::$app->request->queryParams);

		$dataProvider->pagination = [
			'pageSize' => '15',
		];
		
		return $this->render('index',[
			'dataProvider' => $dataProvider,
			'searchModel' => $searchModel,
		]);
	}

}