<?php

use yii\db\Schema;
use yii\db\Migration;

class m151215_032226_create_table_gameserver extends Migration
{
	public function up()
	{
		$tableOptions=null;
		if($this->db->driverName === 'mysql'){
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}
		$this->createTable('{{%game_server}}',[
			'id'=>$this->primaryKey(),
			'server_id'=>$this->integer()->notNull(),
			'server_name'=>$this->string()->notNull(),
			'game_id'=>$this->integer()->notNull(),
			'server_key'=>$this->string()->notNull()->defaultValue(''),
			'start_time'=>$this->integer(),//开服时间
			'slug'=>$this->string(),//服务器名称的拼音

			'is_new'=>$this->smallInteger()->notNull()->defaultValue(0),//0=>不是新服,1=>新服
			'is_hot'=>$this->smallInteger()->notNull()->defaultValue(0),//0=>不是热门,1=>热门,
			'is_recommend'=>$this->smallInteger()->notNull()->defaultValue(0),//0=>不推荐,1=>推荐
			'is_shutdown'=>$this->smallInteger()->notNull()->defaultValue(0),//0=>停服,1=>开启中

			'created_at' => $this->integer()->notNull(),
			'updated_at' => $this->integer()->notNull(),
			'status'=>$this->smallInteger()->notNull(),//status_in_user=>使用中,status_not_userd停用,
			'UNIQUE KEY (server_id,game_id)',//该组合不能重复
		],$tableOptions);

		$this->addForeignKey('fk-game_server-game_id','{{%game_server}}','game_id','{{%game}}','id','CASCADE');
	}

	public function down()
	{
		$this->dropTable('{{%game_server}}');
	}
}
