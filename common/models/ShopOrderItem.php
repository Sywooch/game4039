<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%shop_order_item}}".
 *
 * @property integer $id
 * @property integer $order_id
 * @property string $title
 * @property string $price
 * @property integer $product_id
 * @property double $quantity
 *
 * @property ShopOrder $order
 * @property ShopProduct $product
 */
class ShopOrderItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop_order_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['order_id', 'product_id'], 'integer'],
            [['price', 'quantity'], 'number'],
            [['title'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'order_id' => Yii::t('common', 'Order ID'),
            'title' => Yii::t('common', 'Title'),
            'price' => Yii::t('common', 'Price'),
            'product_id' => Yii::t('common', 'Product ID'),
            'quantity' => Yii::t('common', 'Quantity'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(ShopOrder::className(), ['id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getProduct()
    {
        return $this->hasOne(ShopProduct::className(), ['id' => 'product_id']);
    }
}
