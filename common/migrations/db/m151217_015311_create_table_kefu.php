<?php

use yii\db\Schema;
use yii\db\Migration;

class m151217_015311_create_table_kefu extends Migration
{
	public function up()
	{
		$tableOptions=null;
		if($this->db->driverName == 'mysql'){
			$tableOptions='CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}
		/*
		 * 客服->常见问题分类表
		 * */
		$this->createTable('{{%kefu_faq_cat}}', [
			'id' => $this->primaryKey(),
			'parent_id' => $this->integer(),
			'title' => $this->string()->notNull(),
			'slug' => $this->string()->notNull(),
		], $tableOptions);
		$this->addForeignKey('fk-kefu_faq_cat-parent_id','{{%kefu_faq_cat}}','parent_id','{{%kefu_faq_cat}}','id','CASCADE');

		/*
		 * 客服->常见问题表
		 * */
		$this->createTable('{{%kefu_faq}}',[
			'id'=>$this->primaryKey(),
			'title'=>$this->string()->notNull(),//标题
			'category_id'=>$this->integer()->notNull(),//分类
			'description'=>$this->string(),//描述
			'content'=>$this->text(),//内容
			'created_at' => $this->integer()->notNull(),
			'updated_at' => $this->integer()->notNull(),
			'status'=>$this->smallInteger()->notNull(),//状态,0=>可用,1=>不可用
		],$tableOptions);
		$this->addForeignKey('fk-kefu_faq-category_id','{{%kefu_faq}}','category_id','{{%kefu_faq_cat}}','id','CASCADE');


		/*
		 * 客服->自助服务分类表
		 * */
		$this->createTable('{{%kefu_selfservice_cat}}',[
			'id' => $this->primaryKey(),
			'parent_id' => $this->integer(),
			'title' => $this->string()->notNull(),
			'slug' => $this->string()->notNull(),
		],$tableOptions);
		$this->addForeignKey('fk-kefu_selfservice_cat-parent_id','{{%kefu_selfservice_cat}}','parent_id','{{%kefu_selfservice_cat}}','id','CASCADE');

		/*
		 * 客服->自助服务表
		 * */
		$this->createTable('{{%kefu_selfservice}}', [
			'id' => $this->primaryKey(),
			'sn' =>$this->string(),
			'category_id' => $this->integer()->notNull(),//分类
			'game_role' => $this->string(),//游戏角色名称
			'game_server'=>$this->integer(),//服务器id,填写整数
			'email'=>$this->string(), //联系邮箱
			'phone'=>$this->string(),//手机号码
			'result'=>$this->text(),//处理结果
			'thumbnail_base_url'=>$this->string(1024),
			'thumbnail_path'=>$this->string(1024),
			'content'=>$this->text(),//问题描述
			'user_id'=>$this->integer(),//用户id
			'created_at' => $this->integer()->notNull(),
			'updated_at' => $this->integer()->notNull(),
			'status'=>$this->smallInteger()->notNull(),//状态,0=>可用,1=>不可用
		], $tableOptions);
		$this->addForeignKey('fk-kefuselfservice-user_id', '{{%kefu_selfservice}}', 'user_id', '{{%user}}', 'id');
		$this->addForeignKey('fk-kefu_selfservice-cateogry_id','{{%kefu_selfservice}}','category_id','{{%kefu_selfservice_cat}}','id','CASCADE');

		//客服自助服务附件表
		$this->createTable('{{%kefu_selfservice_attachment}}',[
			'id' => $this->primaryKey(),
			'selfservice_id' => $this->integer()->notNull(),
			'path' => $this->string()->notNull(),
			'base_url' => $this->string(),
			'type' => $this->string(),
			'size' => $this->integer(),
			'name' => $this->string(),
			'created_at' => $this->integer()
		],$tableOptions);
		$this->addForeignKey('fk-kefu_selfservice_attachment-selfservice_id', '{{%kefu_selfservice_attachment}}', 'selfservice_id', '{{%kefu_selfservice}}', 'id', 'cascade', 'cascade');

		/*
		 * 客服QQ表
		 * */
		$this->createTable('{{%kefu_qq}}',[
			'id'=>$this->primaryKey(),
			'qq'=>$this->string(12)->notNull(),
			'user_id'=>$this->integer()->notNull(),//使用者管理员id
			'user_name'=>$this->string()->notNull(),//管理员名称
			'created_at' => $this->integer()->notNull(),
			'updated_at' => $this->integer()->notNull(),
			'status'=>$this->smallInteger()->notNull(),//状态,0=>可用,1=>不可用
		],$tableOptions);
		$this->addForeignKey('fk-kefu_qq-user_id','{{%kefu_qq}}','user_id','{{%admin_user}}','id');

		/*
		 * 客服->申诉表(修复账号)
		 * */
		$this->createTable('{{%kefu_account_repair}}',[
			'id'=>$this->primaryKey(),
			'sn'=>$this->string()->notNull(),//申诉编号

			//第一步填写要修复的账号
			'account'=>$this->string()->notNull(),//修复账号

			//第二步,修复原因
			//0=>账号被盗,1=>忘记密码,2=>忘记注册邮箱,3=>忘记绑定手机号码,4=>修改密保,5=>其他
			'reason'=>$this->integer()->notNull(),//修复账号的原因,

			//第三部填写申请基本资料
			'register_time'=>$this->integer(),//注册时间
			'register_place'=>$this->string(),//注册地点,多个逗号隔开
			'recent_games'=>$this->string(),//最近玩的游戏
			'question_desc'=>$this->text(),//问题描述

			//第四步,填写更多信息
			'bind_email'=>$this->string(),//绑定邮箱
			'security_question_one'=>$this->integer(),//密保问题1,
			'security_question_one_answer'=>$this->string(),//密保问题1答案,
			'security_question_two'=>$this->integer(),//密保问题2,
			'security_question_two_answer'=>$this->string(),//密保问题2答案,

			//第五步,申请人资料
			'applicant_name'=>$this->string(),//申请人姓名
			'applicant_phone'=>$this->string(20),//申请人手机号码
			'applicant_identity'=>$this->string(18),//申请人身份证号码
			'applicant_email'=>$this->string(),//申请人联系邮箱

			'identity_front_base_url'=>$this->string(1024),
			'identity_front_path'=>$this->string(1024),

			'identity_back_base_url'=>$this->string(1024),
			'identity_back_path'=>$this->string(1024),

			'created_at' => $this->integer()->notNull(),
			'updated_at' => $this->integer()->notNull(),

			'progress'=>$this->integer()->notNull(),//申请进度
			'status'=>$this->smallInteger()->notNull(),//状态,0=>可用,1=>不可用

		],$tableOptions);

		$this->addForeignKey('fk-kefu_account_repair-security_question_one','{{%kefu_account_repair}}','security_question_one','{{%security_questions}}','id');
		$this->addForeignKey('fk-kefu_account_repair-security_question_two','{{%kefu_account_repair}}','security_question_two','{{%security_questions}}','id');

	}

	public function down()
	{

		$this->dropTable('{{%kefu_account_repair}}');
		$this->dropTable('{{%kefu_qq}}');
		$this->dropTable('{{%kefu_selfservice_attachment}}');
		$this->dropTable('{{%kefu_selfservice}}');
		$this->dropTable('{{%kefu_selfservice_cat}}');
		$this->dropTable('{{%kefu_faq}}');
		$this->dropTable('{{%kefu_faq_cat}}');
	}
}
