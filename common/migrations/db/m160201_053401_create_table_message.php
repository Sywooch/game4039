<?php

use yii\db\Migration;

class m160201_053401_create_table_message extends Migration
{

	public function up()
	{
		$tableOptions = null;
		if ($this->db->driverName == 'mysql')
		{
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable('{{%message}}', [
			'id' => $this->primaryKey(),//消息id
			'title' => $this->string(),//标题
			'content' => $this->text(),//正文
			'receive' => $this->text(),//消息接收人的ID序列如1,2,3,4...(全站的话ALL_USER)
			'unread' => $this->text(),//未阅读消息的接收人的ID序列,例如1,2,3,4...
			'sender' => $this->string(),//发送消息的用户名
			'created_at' => $this->integer()->notNull(),
			'updated_at' => $this->integer()->notNull(),
			'status' => $this->smallInteger()->notNull(),//该条消息的可用状态
		], $tableOptions);
	}

	public function down()
	{
		$this->dropTable('{{%message}}');
	}
}
