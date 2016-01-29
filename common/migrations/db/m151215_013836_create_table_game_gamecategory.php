<?php

use yii\db\Schema;
use yii\db\Migration;

class m151215_013836_create_table_game_gamecategory extends Migration
{
    public function up()
    {
        $tableOptions = null;
        if ($this->db->driverName === 'mysql')
        {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }
        /*
		 * 角色扮演 战争策略 模拟经营 休闲竞技
		 * */
        $this->createTable('{{%game_category}}', [
            'id' => $this->primaryKey(),
            'parent_id' => $this->integer(),
            'title' => $this->string()->notNull(),
            'slug' => $this->string()->notNull(),
        ], $tableOptions);
        $this->addForeignKey('fk-game_category-parent_id', '{{%game_category}}', 'parent_id', '{{%game_category}}', 'id', 'CASCADE');

        $this->createTable('{{%game}}', [
            'id' => $this->primaryKey(),
            'category_id' => $this->integer()->notNull(),
            'name' => $this->string()->notNull(),
            'description' => $this->text(),
            'short' => $this->string()->notNull(),//游戏简称,首字母

            'api_key' => $this->string(),//游戏代号
            'factory' => $this->string(),//游戏厂商
            'cname' => $this->string(),//游戏服务器的CNAME

            'thumbnail_base_url' => $this->string(1024),//缩略图
            'thumbnail_path' => $this->string(1024),//缩略图地址

            'coin' => $this->string(),//游戏币名称
            'coin_rate' => $this->integer(),//兑换比例1:10
            'game_web_url' => $this->string(),//游戏官网地址
            'game_bbs_url' => $this->string(),//游戏论坛地址
            'api_secret' => $this->string(),//接入密钥
            'api_server' => $this->string(),//游戏列表接口
            'api_play' => $this->string(),//进入游戏接口
            'api_pay' => $this->string(),//充值接口
            'api_check' => $this->string(),//充值检查接口
            'api_order' => $this->string(),//订单接口
            'q' => $this->integer(),//游戏圈子id
            'attr' => $this->smallInteger()->notNull(), //0=>'未接入',1=>'已接入',2=>'接入测试',3=>'停止接入'
            'is_recommend' => $this->smallInteger()->notNull(),
            'is_hot' => $this->smallInteger()->notNull(),
            'is_new' => $this->smallInteger()->notNull(),

            'slug' => $this->string(),//游戏名字的拼音
            'created_at' => $this->integer()->notNull(),
            'updated_at' => $this->integer()->notNull(),
            'status' => $this->smallInteger()->notNull(),//status_in_user=>使用中,status_not_userd停用,
        ], $tableOptions);
        $this->addForeignKey('fk-game-category_id', '{{%game}}', 'category_id', '{{%game_category}}', 'id', 'CASCADE');
    }

    public function down()
    {
        $this->dropTable('{{%game}}');
        $this->dropTable('{{%game_category}}');
    }
}
