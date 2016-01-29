<?php

use yii\db\Schema;
use yii\db\Migration;

class m151217_011144_create_table_securityquestions extends Migration
{

	public function up()
	{
		$tableOptions = null;
		if ($this->db->driverName == 'mysql')
		{
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}
		/*
		* 密保管理表
		* */
		$this->createTable('{{%security_questions}}', [
			'id' => $this->primaryKey(),
			'question' => $this->string()->notNull(),//密保问题
			'created_at' => $this->integer()->notNull(),
			'updated_at' => $this->integer()->notNull(),
			'status' => $this->smallInteger()->notNull(),//状态,1=>可用,0=>不可用
		], $tableOptions);
		/*
		 * 用户密保表
		 * */
		$this->createTable('{{%user_security_questions}}', [
			'id' => $this->primaryKey(),
			'user_id' => $this->integer()->notNull()->unique(),//用户id
			'security_question_one_id' => $this->integer(),//密保问题1 id,
			'security_question_one_answer' => $this->string(),//密保问题1答案,
			'security_question_two_id' => $this->integer(),//密保问题2 id,
			'security_question_two_answer' => $this->string(),//密保问题2答案,
			'created_at' => $this->integer()->notNull(),
			'updated_at' => $this->integer()->notNull(),
			'status' => $this->smallInteger()->notNull(),//状态,1=>可用,0=>不可用
		], $tableOptions);
		$this->addForeignKey('fk-user_security_questions-user_id', '{{%user_security_questions}}', 'user_id', '{{%user}}', 'id', 'CASCADE');
		$this->addForeignKey('fk-user_security_questions-security_questions_one_id', '{{%user_security_questions}}', 'security_question_one_id', '{{%security_questions}}', 'id', 'CASCADE');
		$this->addForeignKey('fk-user_security_questions-security_questions_two_id', '{{%user_security_questions}}', 'security_question_two_id', '{{%security_questions}}', 'id', 'CASCADE');
	}

	public function down()
	{
		$this->dropTable('{{%user_security_questions}}');
		$this->dropTable('{{%security_questions}}');
	}
}
