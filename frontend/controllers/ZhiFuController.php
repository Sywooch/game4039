<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/15
 * Time: 15:30
 * Desc:
 */

namespace frontend\controllers;


use common\models\BeeClound;
use common\models\GameServer;
use frontend\models\ReChargeForm;
use yii\helpers\Json;
use yii\web\Controller;

class ZhiFuController extends Controller
{

	public function actionIndex()
	{
		if (\Yii::$app->user->isGuest)
		{
			return $this->redirect('/user/security/login');
		}

		$model = new ReChargeForm();

		if ($model->load(\Yii::$app->request->post()))
		{
			//(new \common\models\BeeClound(\common\models\BeeClound::CHANNEL_ALI_WEB,'ceshi	',1,[]))->bill();
			//$data["return_url"] = "http://payservice.beecloud.cn";
			//选填 optional
			//$data["optional"] = json_decode(json_encode(array("tag"=>"msgtoreturn")));
			//myVarDump($model->amount);

			//return $this->redirect(['/site/index']);

			$totalFee = (int)$model->amount;
			$beeClound = new BeeClound(BeeClound::CHANNEL_ALI_WEB, '游戏充值', $totalFee, []);
			$beeClound->bill();

		} else
		{
			return $this->render('index', [
				'model' => $model,
			]);
		}
	}

	public function actionConfirm()
	{

	}


	public function actionGetServer()
	{
		$out = [];
		if (isset($_POST['depdrop_parents']))
		{
			$parents = $_POST['depdrop_parents'];
			if ($parents != null)
			{
				$cat_id = $parents[0];
				$gameServer = GameServer::find()->statusInUse()->andFilterWhere(['game_id' => $cat_id])->all();
				foreach ($gameServer as $gs)
				{
					$data = null;
					$data['id'] = $gs->id;
					$data['name'] = $gs->server_name;
					array_push($out, $data);
				}
				//myVarDump($out);
				// the getSubCatList function will query the database based on the
				// cat_id and return an array like below:
				// [
				//    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
				//    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
				// ]
				echo Json::encode(['output' => $out, 'selected' => '']);
				return;
			}
		}
		echo Json::encode(['output' => '', 'selected' => '']);
	}
}