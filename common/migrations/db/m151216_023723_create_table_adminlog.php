<?php

use yii\db\Schema;
use yii\db\Migration;

class m151216_023723_create_table_adminlog extends Migration
{
	public function up()
	{
		$tableOptions = null;
		if ($this->db->driverName === 'mysql') {
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}
		$this->createTable("{{%admin_login_log}}", [
			'id' => $this->bigPrimaryKey(),
			'user_id' => $this->integer()->notNull(),
			'username' => $this->string(),
			'login_ip' => $this->string(),
			'login_time' => $this->integer()->notNull(),
			'os' => $this->string(),
			'category'=>$this->string(),
		], $tableOptions);
		$this->createIndex('idx_log_category',"{{%admin_login_log}}",'category');

		$this->createTable("{{%admin_log}}", [
			'id' => $this->bigPrimaryKey(),
			'level' => $this->integer()->notNull(),
			'category' => $this->string(),
			'log_time' => $this->integer()->notNull(),
			'prefix' => $this->text(),
			'message' => $this->text(),
		], $tableOptions);
		$this->createIndex('idx_log_level',"{{%admin_log}}",'level');
		$this->createIndex('idx_log_category',"{{%admin_log}}",'category');
	}

	public function down()
	{
		$this->dropTable("{{%admin_log}}");
		$this->dropTable("{{%admin_login_log}}");
	}

}
