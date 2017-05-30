<?php

use yii\db\Migration;

class m161109_104201_rename_setting_table extends Migration
{
    public function up()
    {
        try {
            if (Yii::$app->db->schema->getTableSchema('setting') === null) {
                $this->renameTable('{{%Setting}}', '{{%setting}}');
            }
        } catch (\Exception $e) {

        }
    }

    public function down()
    {
        try {
            if (Yii::$app->db->schema->getTableSchema('Setting') === null) {
                $this->renameTable('{{%setting}}', '{{%Setting}}');
            }
        } catch (\Exception $e) {

        }
    }
}
