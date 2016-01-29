<?php

use yii\db\Schema;
use yii\db\Migration;

class m151224_030903_alter_table_profile extends Migration
{

	public function up()
	{
		$this->addColumn('{{%profile}}', 'nickname', $this->string());
		$this->addColumn('{{%profile}}', 'gender', $this->smallInteger());
		$this->addColumn('{{%profile}}', 'identity_num', $this->string());
		$this->addColumn('{{%profile}}', 'qq', $this->string(15));
		$this->addColumn('{{%profile}}', 'birthday', $this->integer());
	}

	public function down()
	{
		$this->dropColumn('{{%profile}}', 'birthday');
		$this->dropColumn('{{%profile}}', 'qq');
		$this->dropColumn('{{%profile}}', 'identity_num');
		$this->dropColumn('{{%profile}}', 'gender');
		$this->dropColumn('{{%profile}}', 'nickname');

	}
}
