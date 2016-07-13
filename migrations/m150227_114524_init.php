<?php

use yii\db\Schema;
use yii\db\Migration;

/**
 * Class m150227_114524_init
 * Init settings table
 */
class m150227_114524_init extends Migration
{
    /**
     * This method contains the logic to be executed when applying this migration.
     */
    public function up()
    {
        $tableOptions = null;

        if ($this->db->driverName === 'mysql') {
            $tableOptions = 'CHARACTER SET utf8 COLLATE utf8_unicode_ci ENGINE=InnoDB';
        }

        $this->createTable('{{%setting}}', [
            'id' => Schema::TYPE_PK,
            'type' => Schema::TYPE_STRING . '(10) NOT NULL',
            'section' => Schema::TYPE_STRING . ' NOT NULL',
            'key' => Schema::TYPE_STRING . ' NOT NULL',
            'value' => Schema::TYPE_TEXT . ' NOT NULL',
            'status' => Schema::TYPE_SMALLINT . ' NOT NULL',
            'createdAt' => Schema::TYPE_INTEGER . ' NOT NULL',
            'updatedAt' => Schema::TYPE_INTEGER . ' NOT NULL',
        ], $tableOptions);
    }

    /**
     * This method contains the logic to be executed when removing this migration.
     */
    public function down()
    {
        $this->dropTable('{{%Setting}}');
    }
}
