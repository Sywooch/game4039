<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/19
 * Time: 9:53
 * Desc:
 */

namespace common\models\query;


use common\models\GameServer;
use yii\db\ActiveQuery;

class GameServerQuery extends ActiveQuery
{
	public function statusInUse()
	{
		$this->andWhere(['status' => GameServer::STATUS_IN_USE]);
		return $this;
	}

}