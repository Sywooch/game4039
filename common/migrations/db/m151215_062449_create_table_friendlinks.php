<?php

use yii\db\Schema;
use yii\db\Migration;

class m151215_062449_create_table_friendlinks extends Migration
{
	public function up()
	{
		$tableOptions=null;
		if($this->db->driverName == 'mysql'){
			$tableOptions='CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable('{{%friends_links}}',[
			'id'=>$this->primaryKey(),
			'name'=>$this->string()->notNull(),
			'url'=>$this->string()->notNull(),
			'category'=>$this->smallInteger()->notNull(),
			'description'=>$this->string(),
			'slug'=>$this->string()->notNull(),
			'sort'=>$this->smallInteger(),

			'created_at'=>$this->integer()->notNull(),
			'updated_at'=>$this->integer()->notNull(),
			'status'=>$this->smallInteger()->notNull(),
		],$tableOptions);
	}

	public function down()
	{
		$this->dropTable('{{%friends_links}}');
	}
}
