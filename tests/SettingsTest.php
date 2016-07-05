<?php

namespace yii2mod\settings\tests;

use Yii;
use yii2mod\settings\models\enumerables\SettingType;

/**
 * Class SettingsTest
 * @package yii2mod\settings\tests
 */
class SettingsTest extends TestCase
{
    public function testNotExistingSetting()
    {
        $this->assertNull(Yii::$app->settings->get('admin', 'email'));
    }

    public function testSetAndGetSetting()
    {
        Yii::$app->settings->set('admin', 'email', 'admin@mail.com');
        $this->assertEquals('admin@mail.com', Yii::$app->settings->get('admin', 'email'));
    }

    public function testRemoveSetting()
    {
        Yii::$app->settings->set('admin', 'email', 'admin@mail.com');
        $this->assertEquals('admin@mail.com', Yii::$app->settings->get('admin', 'email'));
        Yii::$app->settings->remove('admin', 'email');
        $this->assertNull(Yii::$app->settings->get('admin', 'email'));
    }

    public function testSetSettingWithType()
    {
        Yii::$app->settings->set('cron', 'activeEmailCommand', 'false', SettingType::BOOLEAN_TYPE);
        $this->assertFalse(Yii::$app->settings->get('cron', 'activeEmailCommand'));
    }
}