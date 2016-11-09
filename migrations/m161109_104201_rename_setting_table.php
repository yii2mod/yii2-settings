<?php

use app\components\Migration;

class m161109_104201_rename_setting_table extends Migration
{
    public function up()
    {
        $this->renameTable('{{%Setting}}', '{{%setting}}');
    }

    public function down()
    {
        $this->renameTable('{{%setting}}', '{{%Setting}}');
    }

    /*
    // Use safeUp/safeDown to run migration code within a transaction
    public function safeUp()
    {
    }

    public function safeDown()
    {
    }
    */
}
