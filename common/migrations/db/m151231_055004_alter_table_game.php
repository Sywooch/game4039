<?php

use yii\db\Schema;
use yii\db\Migration;

class m151231_055004_alter_table_game extends Migration
{

	public function up()
	{
		$this->addColumn('{{%game}}', 'sort', $this->integer()->defaultValue(0));
		$this->alterColumn('{{%game}}', 'is_recommend', $this->smallInteger()->defaultValue(0));
		$this->dropColumn('{{%game}}', 'is_hot');
		$this->dropColumn('{{%game}}', 'is_new');

	}

	public function down()
	{
		$this->addColumn('{{%game}}', 'is_new', $this->smallInteger()->notNull());
		$this->addColumn('{{%game}}', 'is_hot', $this->smallInteger()->notNull());
		$this->alterColumn('{{%game}}', 'is_recommend', $this->smallInteger()->notNull());
		$this->dropColumn('{{%game}}', 'sort');
	}
}
