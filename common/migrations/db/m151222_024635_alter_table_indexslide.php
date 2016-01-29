<?php

use yii\db\Schema;
use yii\db\Migration;

class m151222_024635_alter_table_indexslide extends Migration
{

	public function up()
	{
		$this->addColumn('{{%index_slide}}', 'sort', $this->integer()->defaultValue(0));
	}

	public function down()
	{
		$this->dropColumn('{{%index_slide}}', 'sort');
	}
}
