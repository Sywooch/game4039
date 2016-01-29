<?php

use yii\db\Schema;
use yii\db\Migration;

class m151214_074617_modified_table_article extends Migration
{
    public function up()
    {
        $this->renameColumn('{{%article}}','attr','recommend');
    }

    public function down()
    {
        $this->renameColumn('{{%article}}','recommend','attr');
    }
}
