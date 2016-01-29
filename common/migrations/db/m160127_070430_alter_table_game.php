<?php

use yii\db\Schema;
use yii\db\Migration;

class m160127_070430_alter_table_game extends Migration
{
    public function up()
    {
		$this->addColumn('{{%game}}', 'bg_image_base_url', $this->string(1024));
		$this->addColumn('{{%game}}', 'bg_image_path', $this->string(1024));
    }

    public function down()
    {
		$this->dropColumn('{{%game}}', 'bg_image_path');
		$this->dropColumn('{{%game}}', 'bg_image_base_url');
    }

}
