<?php
/**
 * Created by PhpStorm.
 * User: buuug7
 * Date: 2016/1/11
 * Time: 13:35
 * Desc:
 */

namespace common\models\query;


use common\models\ShopProduct;
use yii\db\ActiveQuery;

class ShopProductQuery extends ActiveQuery
{

	public function statusInUseAndOnSale()
	{
		$this->andWhere(['status' => ShopProduct::STATUS_IN_USE, 'is_on_sale' => ShopProduct::IS_ON_SALE_UP]);
		return $this;
	}

}