<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/12/22
 * Time: 9:22
 * Desc:
 */

namespace common\models\query;


use common\models\Game;
use yii\db\ActiveQuery;

class GameQuery extends ActiveQuery
{

	public function statusInUse()
	{
		$this->andWhere(['status' => Game::STATUS_IN_USE]);
		return $this;
	}

}