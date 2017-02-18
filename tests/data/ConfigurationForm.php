<?php

namespace yii2mod\settings\tests\data;

use yii\base\Model;

class ConfigurationForm extends Model
{
    /**
     * @var string application name
     */
    public $appName;

    /**
     * @var string admin email
     */
    public $adminEmail;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['appName', 'adminEmail'], 'required'],
        ];
    }
}
