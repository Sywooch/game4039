<?php

use yii\db\Schema;
use yii\db\Migration;

class m151215_053139_create_table_activity_activitycategory extends Migration
{
	public function up()
	{
		$tableOptions=null;
		if($this->db->driverName == 'mysql'){
			$tableOptions='CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}
		//活动分类表
		$this->createTable('{{%activity_category}}',[
			'id'=>$this->primaryKey(),
			'parent_id'=>$this->integer(),
			'title'=>$this->string()->notNull(),
			'slug'=>$this->string()->notNull(),
		],$tableOptions);
		$this->addForeignKey('fk-activity_category-parent_id','{{%activity_category}}','parent_id','{{%activity_category}}','id','CASCADE');

		//活动主表
		$this->createTable('{{%activity}}',[
			'id'=>$this->primaryKey(),
			'category_id'=>$this->integer()->notNull(),//,0=>热门活动,1=>推荐活动,2=>其他活动
			'title'=>$this->string()->notNull(),
			'description'=>$this->text(),
			'url'=>$this->string(),
			'start_time'=>$this->integer(),
			'end_time'=>$this->integer(),
			'thumbnail_base_url'=>$this->string(1024),
			'thumbnail_path'=>$this->string(1024),
			'content'=>$this->text(),
			'slug'=>$this->string()->notNull(),

			'created_at'=>$this->integer()->notNull(),
			'updated_at'=>$this->integer()->notNull(),
			'status'=>$this->smallInteger()->notNull(),
		],$tableOptions);
		$this->addForeignKey('fk-activity-category_id-activity_category-id','{{%activity}}','category_id','{{%activity_category}}','id','CASCADE');
	}

	public function down()
	{
		$this->dropTable('{{%activity}}');
		$this->dropTable('{{%activity_category}}');
	}
}
