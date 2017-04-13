<?php

use yii\db\Migration;

class m170413_125133_rename_date_columns extends Migration
{
    public function up()
    {
        $this->renameColumn('{{%setting}}', 'createdAt', 'created_at');
        $this->renameColumn('{{%setting}}', 'updatedAt', 'updated_at');
    }

    public function down()
    {
        $this->renameColumn('{{%setting}}', 'created_at', 'createdAt');
        $this->renameColumn('{{%setting}}', 'updated_at', 'updatedAt');
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
