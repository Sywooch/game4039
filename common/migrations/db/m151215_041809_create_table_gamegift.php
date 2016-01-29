<?php

use yii\db\Schema;
use yii\db\Migration;

class m151215_041809_create_table_gamegift extends Migration
{
	public function up()
	{
		$tableOptions = null;
		if ($this->db->driverName === 'mysql')
		{
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}
		$this->createTable('{{%game_gift}}', [
			'id' => $this->primaryKey(),
			'game_id'=>$this->integer()->notNull(),//对应游戏id
			'game_server_id' => $this->integer(),//对应游戏服务器id
			'lb_gid' => $this->string()->notNull(),//礼包GID
			'lb_name' => $this->string()->notNull(),//礼包名称
			'lb_type' => $this->string()->notNull(),//礼包类型
			'lb_method' => $this->text(),//领取方法
			'lb_content' => $this->text(),//礼包内容
			'slug' => $this->string()->notNull(),//礼包名称的拼音

			'created_at' => $this->integer()->notNull(),
			'updated_at' => $this->integer()->notNull(),
			'status' => $this->smallInteger()->notNull(),

			'UNIQUE KEY (lb_gid,game_id)',
		], $tableOptions);
		$this->addForeignKey('fk-game_gift-game_server_id', '{{%game_gift}}', 'game_server_id', '{{%game_server}}', 'id', 'CASCADE');
	}

	public function down()
	{
		$this->dropTable('{{%game_gift}}');
	}
}
