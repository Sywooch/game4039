<?php

use yii\db\Schema;
use yii\db\Migration;

class m151218_012345_create_table_userhistory extends Migration
{

	public function up()
	{
		$tableOptions = null;
		if ($this->db->driverName === 'mysql')
		{
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}
		$this->createTable('{{%user_history}}', [
			'id' => $this->primaryKey(),
			'user_id' => $this->integer()->notNull(),
			'game_id' => $this->integer()->notNull(),
			'server_id' => $this->integer()->notNull(),
			'created_at' => $this->integer()->notNull(),
			'status' => $this->smallInteger()->notNull(),//状态,0=>可用,1=>不可用

			'UNIQUE KEY (user_id,server_id,created_at)',//该组合不能重复

		], $tableOptions);
		$this->addForeignKey('fk-user_history-user_id', '{{%user_history}}', 'user_id', '{{%user}}', 'id', 'CASCADE');
		$this->addForeignKey('fk-user_history-server_id', '{{%user_history}}', 'server_id', '{{%game_server}}', 'id', 'CASCADE');
	}

	public function down()
	{
		$this->dropTable('{{%user_history}}');
	}
}
