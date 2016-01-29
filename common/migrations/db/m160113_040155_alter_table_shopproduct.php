<?php

use yii\db\Schema;
use yii\db\Migration;

class m160113_040155_alter_table_shopproduct extends Migration
{

	public function up()
	{
		$this->addColumn('{{%shop_product}}', 'relation_game', $this->integer());
	}

	public function down()
	{
		$this->dropColumn('{{%shop_product}}', 'relation_game');
	}
}
