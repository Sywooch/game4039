<?php
namespace common\util;

use common\models\Activity;
use common\models\ActivityCategory;
use common\models\Article;
use common\models\FriendsLinks;
use common\models\Game;
use common\models\GameCategory;
use common\models\GameServer;
use common\models\IndexSlide;
use common\models\PlayerAlbum;
use common\models\ShopProduct;
use common\models\UserHistory;
use common\models\UserSecurityQuestions;
use dektrium\user\models\User;
use common\models\KefuFaq;
use common\models\KefuFaqCat;

/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/12/16
 * Time: 15:25
 * Desc:
 */
class Buuug7Util
{

	/*
	 * save administrator important information to admin_log table
	 * */
	public static function saveInfoToAdminLogTable($message)
	{
		$log = new \yii\log\DbTarget();
		$log->logTable = '{{%admin_log}}';
		$log->messages[] = [$message, 4, __METHOD__, time()];
		$log->export();
	}

	/*
	 * save user important information to user_log table
	 * */
	public static function saveInfoToUserLogTable($message)
	{
		$log = new \yii\log\DbTarget();
		$log->logTable = '{{%user_log}}';
		$log->messages[] = [$message, 4, __METHOD__, time()];
		$log->export();
	}

	public static function textUserSecurityQuestions($user_id)
	{
		$userSecurityQuestions = new UserSecurityQuestions();
		$userSecurityQuestions->user_id = $user_id;
		$userSecurityQuestions->status = UserSecurityQuestions::STATUS_IN_USE;
		$userSecurityQuestions->save();
	}

	/*
     * add frontend user game history
     * */
	public static function addUserHistory($serverId)
	{
		$server = \common\models\GameServer::findOne($serverId);
		$game = $server->getGame()->one();
		$user = \Yii::$app->user->identity;
		$user = User::findOne(2);

		$userHistory = new UserHistory();

		$userHistory->user_id = $user->getId();
		$userHistory->game_id = $server->game_id;
		$userHistory->server_id = $server->id;

		$userHistory->status = UserHistory::STATUS_IN_USE;
		if ($userHistory->save())
		{
			return $userHistory;
		} else
		{
			return null;
		}
	}

	/*
	 * get User History by user_id
	 * */
	public static function getRecentUserHistory($id)
	{
		return UserHistory::find()->where(['status' => UserHistory::STATUS_IN_USE, 'user_id' => $id])->orderBy('created_at DESC')->limit(5)->all();
	}

	/*
	 * query all friend links
	 * */
	public static function getLinks()
	{
		return FriendsLinks::find()->where(['status' => FriendsLinks::STATUS_IN_USE])->all();
	}

	/*
	 * query status_in_use games
	 * */
	public static function getActiveGames()
	{
		return Game::find()->statusInUse()->all();
	}

	/**
	 * @param $flag
	 * if param flag equals true will return  recommend games
	 * otherwise it will return not recommend games
	 * @return array|\yii\db\ActiveRecord[]
	 */
	public static function getGameByFlag($flag = false)
	{
		$query = Game::find()->statusInUse()->orderBy(['sort' => SORT_DESC, 'updated_at' => SORT_DESC]);
		if ($flag)
		{
			return $query->andWhere(['is_recommend' => Game::IS_RECOMMEND_YES])->all();
		}
		return $query->andWhere(['is_recommend' => Game::IS_RECOMMEND_NO])->all();

	}

	/*
	 * query games by category'slug
	 * */
	public static function getActiveGamesByCategorySlug($slug)
	{
		$gameCat = GameCategory::find()->where(['slug' => $slug])->one();
		if ($gameCat != null)
		{
			return Game::find()->where(['status' => Game::STATUS_IN_USE, 'category_id' => $gameCat->id])->all();
		}
		return null;
	}

	/*
	 * get recent article
	 * */
	public static function getRecentArticles()
	{
		return Article::find()->published()->orderBy('published_at DESC')->limit(5)->all();
	}

	/*
	 * get active index slide
	 * */
	public static function getActiveIndexSlide()
	{
		return IndexSlide::find()->where(['status' => IndexSlide::STATUS_IN_USE])->orderBy('sort ASC')->all();
	}

	/*
	 * query actived playeralbum
	 * */
	public static function getStatusInUsePlayerAlbum()
	{
		return PlayerAlbum::find()->where(['status' => PlayerAlbum::STATUS_IN_USE])->orderBy('updated_at DESC')->all();
	}

	/*
	 * query gameserver where actived
	 * */
	public static function getStatusInUseGameServer()
	{
		return GameServer::find()->where(['status' => GameServer::STATUS_IN_USE])->orderBy('updated_at DESC')->all();
	}

	/*
	 *  get activityCategory model
	 * */
	public static function getActivityCat()
	{
		return ActivityCategory::find()->all();
	}

	/*
	 *  get activities data provider by activitycategory slug
	 * */
	public static function getActivitiesDataProviderByCatSlug($dataProvider, $slug)
	{
		$activityCat = ActivityCategory::findOne(['slug' => $slug]);
		$dataProvider->query->FilterWhere(['category_id' => $activityCat->id, 'status' => Activity::STATUS_IN_USE]);
		$dataProvider->pagination = [
			'pageSize' => 10,
		];
		$dataProvider->refresh();
		return $dataProvider;
	}

	public static function getActivitiesByLimit($limit)
	{
		return Activity::find()->statusInUse()->orderBy('sort DESC')->limit($limit)->all();
	}

	/**
	 * @param null $cat
	 * @return int|string
	 */
	public static function getOnSaleProductCount($cat = null)
	{
		$query = ShopProduct::find()->statusInUseAndOnSale();
		if ($cat != null)
		{
			$query->andWhere(['category_id' => $cat]);
		}
		return $query->count();
	}


	/**
	 * 通过客服常用问题分类的slug获取该分类下的所有数据
	 * @param $categorySlug 客服常用问题分类slug
	 * @param $limit	限制返回的数据个数
	 * @return array|\yii\db\ActiveRecord[]
	 */
	public static function getKefuFaqbyCategorySlug($categorySlug,$limit){
		$qiTaWenTis=KefuFaq::find()->where(['status' => KefuFaq::STATUS_IN_USE,'category_id' => KefuFaqCat::findOne(['slug' => $categorySlug])['id']])->orderBy("created_at DESC")->limit($limit)->all();
		return $qiTaWenTis;
	}
}