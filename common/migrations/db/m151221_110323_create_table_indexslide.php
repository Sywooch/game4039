<?php

use yii\db\Schema;
use yii\db\Migration;

class m151221_110323_create_table_indexslide extends Migration
{

	public function up()
	{
		$tableOptions = null;
		if ($this->db->driverName === 'mysql')
		{
			$tableOptions = "CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB";
		}
		$this->createTable('{{%index_slide}}', [
			'id' => $this->primaryKey(),
			'game_id' => $this->integer()->notNull(),//游戏id
			'name' => $this->string(),//名称
			'caption' => $this->string(),//带格式的标题
			'description' => $this->text(),//带格式的描述
			'access_url' => $this->string(1024),//进入游戏url
			'official_url' => $this->string(1024),//进入官网url
			'thumbnail_base_url' => $this->string(1024),
			'thumbnail_path' => $this->string(1024),
			'created_at' => $this->integer()->notNull(),
			'updated_at' => $this->integer()->notNull(),
			'status' => $this->smallInteger()->notNull(),
		], $tableOptions);
		$this->addForeignKey('fk-index_slider-game_id', '{{%index_slide}}', 'game_id', '{{%game}}', 'id', 'cascade', 'cascade');
	}

	public function down()
	{
		$this->dropTable('{{%index_slide}}');
	}
}
