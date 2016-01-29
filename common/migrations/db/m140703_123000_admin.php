<?php

use backend\models\User;
use yii\db\Schema;
use yii\db\Migration;

class m140703_123000_admin extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%admin_user}}', [
            'id' => $this->primaryKey(),
            'username' => $this->string(32),
            'auth_key' => $this->string(32)->notNull(),
            'access_token' => $this->string(40)->notNull(),
            'password_hash' => $this->string()->notNull(),
            'password_reset_token' => $this->string(),
            'oauth_client' => $this->string(),
            'oauth_client_user_id' => $this->string(),
            'email' => $this->string()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(User::STATUS_ACTIVE),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
            'logged_at' => $this->integer()
        ], $tableOptions);

        $this->createTable('{{%admin_profile}}', [
            'user_id' => $this->primaryKey(),
            'real_name'=>$this->string(),
            'avatar_path' => $this->string(),
            'avatar_base_url' => $this->string(),
            'locale' => $this->string(32)->notNull(),
            'gender' => $this->smallInteger(1)
        ], $tableOptions);

        $this->addForeignKey('fk_user', '{{%admin_profile}}', 'user_id', '{{%admin_user}}', 'id', 'cascade', 'cascade');

    }

    public function down()
    {
        $this->dropForeignKey('fk_user', '{{%admin_profile}}');
        $this->dropTable('{{%admin_profile}}');
        $this->dropTable('{{%admin_user}}');

    }
}
