<?php

use yii\db\Migration;

class m161109_104201_rename_setting_table extends Migration
{
    public function up()
    {
        if (Yii::$app->db->schema->getTableSchema('{{%setting}}') === null) {
            $this->renameTable('{{%Setting}}', '{{%setting}}');
        }
    }

    public function down()
    {
        if (Yii::$app->db->schema->getTableSchema('Setting') === null) {
            $this->renameTable('{{%setting}}', '{{%Setting}}');
        }
    }
}
