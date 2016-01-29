<?php

use yii\db\Schema;
use yii\db\Migration;

class m151217_054925_alter_table_kefuselfservice extends Migration
{

	public function up()
	{
		$this->dropColumn('{{%kefu_selfservice}}', 'thumbnail_base_url');
		$this->dropColumn('{{%kefu_selfservice}}', 'thumbnail_path');
	}

	public function down()
	{
		$this->addColumn('{{%kefu_selfservice}}', 'thumbnail_path', $this->string(1024));
		$this->addColumn('{{%kefu_selfservice}}', 'thumbnail_base_url', $this->string(1024));
	}
}
