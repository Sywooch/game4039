<?php

use yii\db\Schema;
use yii\db\Migration;

class m160125_020609_alter_table_recharge extends Migration
{

	public function up()
	{
		$this->addColumn('{{%recharge}}', 'pay_mode', $this->string());//支付方式
		$this->alterColumn('{{%recharge}}', 'role_id', $this->string());
	}

	public function down()
	{
		$this->alterColumn('{{%recharge}}', 'role_id', $this->string()->notNull());
		$this->dropColumn('{{%recharge}}', 'pay_mode');
	}
}
