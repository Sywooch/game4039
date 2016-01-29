<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2015/12/31
 * Time: 12:29
 * Desc:
 */

namespace common\models\query;


use common\models\Activity;
use yii\db\ActiveQuery;

class ActivityQuery extends ActiveQuery
{
	public function statusInUse(){
		$this->andWhere(['status'=>Activity::STATUS_IN_USE]);
		return $this;
	}
}