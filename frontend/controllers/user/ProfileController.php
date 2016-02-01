<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/12/23
 * Time: 14:36
 * Desc:
 */

namespace frontend\controllers\user;

use common\models\Message;
use common\models\UserHistory;
use common\util\DzHelper;
use Yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;


class ProfileController extends \dektrium\user\controllers\ProfileController
{

	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					['allow' => true, 'actions' => ['index', 'user-history', 'credits', 'user-message'], 'roles' => ['@']],
					['allow' => true, 'actions' => ['show'], 'roles' => ['?', '@']],
				],
			],
		];
	}


	/**
	 * Redirects to current user's profile.
	 *
	 * @return \yii\web\Response
	 */
	public function actionIndex()
	{
		return $this->redirect(['show', 'id' => Yii::$app->user->getId()]);
	}

	public function actionUserHistory()
	{
		$user = Yii::$app->user->identity;
		$query = UserHistory::find()->where(['status' => UserHistory::STATUS_IN_USE, 'user_id' => $user->getId()])->orderBy('created_at DESC');
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => [
				'pageSize' => 10
			]
		]);

		return $this->render('user-history', [
			'dataProvider' => $dataProvider,
		]);
	}

	public function actionCredits()
	{

		return $this->render('credits', [
			'dzUser' => (new DzHelper())->getDzUserByUsername(Yii::$app->user->identity->username)]);
	}

	public function actionUserMessage()
	{
		$user = Yii::$app->user->identity;
		$query = Message::find()->where(['status' => Message::STATUS_ACTIVE])->orderBy('created_at DESC');
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => [
				'pageSize' => 2
			]
		]);

		return $this->render('user-message', [
			'dataProvider' => $dataProvider,
		]);
	}

}