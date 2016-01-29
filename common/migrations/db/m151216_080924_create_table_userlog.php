<?php

use yii\db\Schema;
use yii\db\Migration;

class m151216_080924_create_table_userlog extends Migration
{
	public function up()
	{
		$tableOptions = null;
		if ($this->db->driverName === 'mysql') {
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}

		$this->createTable("{{%user_login_log}}", [
			'id' => $this->bigPrimaryKey(),
			'user_id' => $this->integer()->notNull(),
			'username' => $this->string(),
			'login_ip' => $this->string(),
			'login_time' => $this->integer()->notNull(),
			'os' => $this->string(),
			'category'=>$this->string(),
		], $tableOptions);
		$this->createIndex('idx_log_category',"{{%user_login_log}}",'category');

		$this->createTable("{{%user_log}}", [
			'id' => $this->bigPrimaryKey(),
			'level' => $this->integer()->notNull(),
			'category' => $this->string(),
			'log_time' => $this->integer()->notNull(),
			'prefix' => $this->text(),
			'message' => $this->text(),
		], $tableOptions);
		$this->createIndex('idx_log_level',"{{%user_log}}",'level');
		$this->createIndex('idx_log_category',"{{%user_log}}",'category');
	}

	public function down()
	{
		$this->dropTable("{{%user_log}}");
		$this->dropTable("{{%user_login_log}}");
	}
}
