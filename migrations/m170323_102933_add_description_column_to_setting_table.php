<?php

use yii\db\Migration;

/**
 * Handles adding description to table `setting`.
 */
class m170323_102933_add_description_column_to_setting_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->addColumn('{{%setting}}', 'description', $this->string()->after('status'));
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropColumn('{{%setting}}', 'description');
    }
}
