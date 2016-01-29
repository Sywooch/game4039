<?php

use yii\db\Schema;
use yii\db\Migration;

class m151218_070458_create_table_playeralbum extends Migration
{
	public function up()
	{
		$tableOptions=null;
		if($this->db->driverName === 'mysql'){
			$tableOptions='CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
		}
		$this->createTable('{{%player_album}}',[
			'id'=>$this->primaryKey(),
			'user_id' => $this->integer()->notNull(),
			'thumbnail_base_url' => $this->string(1024),
			'thumbnail_path' => $this->string(1024),
			'url'=>$this->string(1024),
			'created_at'=>$this->integer()->notNull(),
			'updated_at'=>$this->integer()->notNull(),
			'status'=>$this->integer()->notNull(),
		],$tableOptions);
		$this->addForeignKey('fk-player_album-user_id','{{%player_album}}','user_id','{{%user}}','id','cascade','cascade');
	}
	public function down()
	{
		$this->dropTable('{{%player_album}}');
	}
}
