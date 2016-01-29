<?php

use yii\db\Schema;
use yii\db\Migration;

class m151220_093352_alter_table_kefuaccountrepair extends Migration
{

	public function up()
	{
		$this->alterColumn('{{%kefu_account_repair}}', 'account', $this->integer()->notNull());
		$this->alterColumn('{{%kefu_account_repair}}', 'recent_games', $this->integer());
	}

	public function down()
	{
		$this->alterColumn('{{%kefu_account_repair}}', 'recent_games', $this->string());
		$this->alterColumn('{{%kefu_account_repair}}', 'account', $this->string()->notNull());
	}
}
