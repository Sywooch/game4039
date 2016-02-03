<?php

use yii\db\Schema;
use yii\db\Migration;

class m160203_050036_alter_table_message extends Migration
{

	public function up()
	{
		$this->addColumn('{{%message}}', 'deleted', $this->text()->defaultValue(null));

	}

	public function down()
	{
		$this->dropColumn('{{%message}}', 'deleted');
	}
}
