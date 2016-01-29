<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/15
 * Time: 11:13
 * Desc:
 */

namespace frontend\controllers;


use common\models\Game;
use frontend\models\search\GameSearch;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use yii\web\Controller;

class GameController extends Controller
{

	public function actionIndex()
	{

		$searchModel = new GameSearch();
		$dataProvider = $searchModel->search(\Yii::$app->request->queryParams);
		$dataProvider->sort = [
			'defaultOrder' => ['created_at' => SORT_DESC]
		];
		return $this->render('index', ['dataProvider' => $dataProvider]);

	}

	public function actionView($slug)
	{
		$this->layout='singlepage';
		$game = Game::findOne(['slug' => $slug]);
		if (!$game)
		{
			throw new NotFoundHttpException('您请求的页面不存在!');
		}
		//myVarDump($game);
		return $this->render('view', [
			'model' => $game,

		]);
	}

}