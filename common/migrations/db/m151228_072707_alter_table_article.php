<?php

use yii\db\Schema;
use yii\db\Migration;

class m151228_072707_alter_table_article extends Migration
{

	public function up()
	{
		$this->addColumn('{{%article}}', 'stars', $this->bigInteger()->defaultValue(0));
	}

	public function down()
	{
		$this->dropColumn('{{%article}}', 'stars');
	}
}
