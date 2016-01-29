<?php

use yii\db\Schema;
use yii\db\Migration;

class m151231_051725_alter_table_activity extends Migration
{

	public function up()
	{
		$this->addColumn('{{%activity}}', 'sort', $this->integer()->defaultValue(0));

	}

	public function down()
	{
		$this->dropColumn('{{%activity}}', 'sort');
	}
}
