<?php

use yii\db\Schema;
use yii\db\Migration;

class m151215_075203_create_table_shop_shopcategory extends Migration
{
	public function up()
	{

		$tableOptions = null;
		if ($this->db->driverName === 'mysql') {
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}
		//产品分类表
		$this->createTable('{{%shop_category}}', [
			'id' => $this->primaryKey(),
			'parent_id' => $this->integer(),
			'title' => $this->string()->notNull(),
			'slug' => $this->string()->notNull(),
		], $tableOptions);
		$this->addForeignKey('fk-shop_category-parent_id', '{{%shop_category}}', 'parent_id', '{{%shop_category}}', 'id', 'CASCADE');

		//产品表
		$this->createTable('{{%shop_product}}', [
			'id' => $this->primaryKey(),
			'title' => $this->string()->notNull(),
			'slug' => $this->string()->notNull(),
			'description' => $this->text(),
			'category_id' => $this->integer()->notNull(),
			'price' => $this->money(),
			'jifen'=>$this->integer(),
			'content'=>$this->text(),
			'keywords'=>$this->string(),

			'thumbnail_base_url'=>$this->string(1024),
			'thumbnail_path'=>$this->string(1024),

			'img_base_url'=>$this->string(1024),
			'img_path'=>$this->string(1024),

			'product_number'=>$this->integer(),
			'return_jifen'=>$this->integer(),
			'is_on_sale'=>$this->smallInteger()->notNull()->defaultValue(0),
			'is_delete'=>$this->smallInteger()->notNull()->defaultValue(0),
			'is_hot'=>$this->smallInteger()->notNull()->defaultValue(0),
			'is_promote'=>$this->smallInteger()->notNull()->defaultValue(0),
			'is_check'=>$this->smallInteger()->notNull()->defaultValue(0),

			'created_at'=>$this->integer()->notNull(),
			'updated_at'=>$this->integer()->notNull(),

			'status'=>$this->smallInteger()->notNull(),
		], $tableOptions);
		$this->addForeignKey('fk-shop_product-catogory_id', '{{%shop_product}}', 'category_id', '{{%shop_category}}', 'id', 'RESTRICT');

		//产品图片表
		$this->createTable('{{%shop_image}}', [
			'id' => $this->primaryKey(),
			'product_id' => $this->integer(),
		], $tableOptions);
		$this->addForeignKey('fl-shop_image-product_id', '{{%shop_image}}', 'product_id', '{{%shop_product}}', 'id', 'SET NULL');

		//订单表
		$this->createTable('{{%shop_order}}', [
			'id' => Schema::TYPE_PK,
			'created_at' => $this->integer()->notNull(),
			'updated_at' => $this->integer()->notNull(),
			'phone' => $this->string(),
			'address' => $this->text(),
			'email' => $this->string(),
			'notes' => $this->text(),
			'status' => $this->string(),
			'order_sn'=>$this->string(255),
			'user_id'=>$this->integer(),
		], $tableOptions);
		$this->addForeignKey('fk-shop_order-user_id','{{%shop_order}}','user_id','{{%user}}','id','CASCADE');

		//订单详情表
		$this->createTable('{{%shop_order_item}}', [
			'id' => $this->primaryKey(),
			'order_id' => $this->integer(),
			'title' => $this->string(),
			'price' => $this->money(),
			'product_id' => $this->integer(),
			'quantity' => $this->float(),
		], $tableOptions);

		$this->addForeignKey('fk-shop_order_item-order_id', '{{%shop_order_item}}', 'order_id', '{{%shop_order}}', 'id', 'CASCADE');
		$this->addForeignKey('fk-shop_order_item-product_id', '{{%shop_order_item}}', 'product_id', '{{%shop_product}}', 'id', 'SET NULL');
	}

	public function down()
	{
		$this->dropTable('{{%shop_order_item}}');
		$this->dropTable('{{%shop_order}}');
		$this->dropTable('{{%shop_image}}');
		$this->dropTable('{{%shop_product}}');
		$this->dropTable('{{%shop_category}}');
	}
}
