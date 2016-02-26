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
use yii\data\SqlDataProvider;
use yii\filters\AccessControl;


class ProfileController extends \dektrium\user\controllers\ProfileController
{

	public function behaviors()
	{
		return [
			'access' => [
				'class' => AccessControl::className(),
				'rules' => [
					['allow' => true, 'actions' => ['index', 'user-history', 'credits', 'user-message','delete-user-message-by-user-id'], 'roles' => ['@']],
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


	/**
	 * 用户消息控制器
	 * @return string
	 */
	public function actionUserMessage()
	{
		$user = Yii::$app->user->identity;

		$query = Message::find()->where("NOT FIND_IN_SET({$user->getId()},`deleted`)");
		$query=$query->andFilterWhere(['status' => Message::STATUS_ACTIVE])->orderBy('created_at DESC');
		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => [
				'pageSize' =>10
			]
		]);
		return $this->render('user-message', [
			'dataProvider' => $dataProvider,
		]);
	}

	/**
	 * ajax 删除用户的消息
	 * @return string
	 */
	public function actionDeleteUserMessageByUserId(){
		$post=Yii::$app->request->post();
		$user=Yii::$app->user->identity;
		$data=[];

		if($post['messageId']){
			if(Message::deleteMessageByUserId($post['messageId'],$user->getId())){
				$data['msg']='成功删除一条消息!';
			}else{
				$data['msg']='删除失败,请稍后再试!';
			}
		}else{
			$data['msg']='系统异常!';
		}
		return json_encode($data);
	}

}