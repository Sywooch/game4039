<?php

use yii\db\Schema;
use yii\db\Migration;

class m160119_010616_create_table_recharge extends Migration
{

	public function up()
	{
		$tableOptions = null;
		if ($this->db->driverName == 'mysql')
		{
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable('{{%recharge}}', [
			'id' => $this->primaryKey(),
			'user_id' => $this->integer()->notNull(),//用户ID
			'game_id' => $this->integer()->notNull(),//游戏ID
			'server_id' => $this->integer()->notNull(),//服务器ID
			'role_id' => $this->string()->notNull(),//角色ID
			'amount' => $this->money()->notNull(),//充值金额
			'order_id' => $this->string()->notNull(),//交易号
			'created_at' => $this->integer()->notNull(),//充值时间
			'status' => $this->smallInteger()->defaultValue(0),//0=>失败,1=>成功
		], $tableOptions);

		$this->addForeignKey('fk-recharge-user_id', '{{%recharge}}', 'user_id', '{{%user}}', 'id', 'CASCADE');
		$this->addForeignKey('fk-recharge-game_id', '{{%recharge}}', 'game_id', '{{%game}}', 'id', 'CASCADE');
		$this->addForeignKey('fk-recharge-server_id', '{{%recharge}}', 'server_id', '{{%game_server}}', 'id', 'CASCADE');

	}

	public function down()
	{
		$this->dropTable('{{%recharge}}');
	}
}
