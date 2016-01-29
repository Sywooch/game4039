<?php

use yii\db\Schema;
use yii\db\Migration;

class m151230_102824_alter_table_activity extends Migration
{

	public function up()
	{
		$this->addColumn('{{%activity}}', 'guize', $this->string());//活动规则
		$this->addColumn('{{%activity}}', 'jiangli', $this->string());//活动奖励
		$this->addColumn('{{%activity}}', 'jiangli_fangfa', $this->string());//领取奖励方法

		$this->addColumn('{{%activity}}', 'bg_image_base_url', $this->string(1024));
		$this->addColumn('{{%activity}}', 'bg_image_path', $this->string(1024));

		$this->addColumn('{{%activity}}', 'relation_game_id', $this->integer());
	}

	public function down()
	{
		$this->dropColumn('{{%activity}}', 'relation_game_id');

		$this->dropColumn('{{%activity}}', 'bg_image_path');
		$this->dropColumn('{{%activity}}', 'bg_image_base_url');

		$this->dropColumn('{{%activity}}', 'jiangli_fangfa');
		$this->dropColumn('{{%activity}}', 'jiangli');
		$this->dropColumn('{{%activity}}', 'guize');
	}
}
