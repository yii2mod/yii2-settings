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

    public function testHasSetting()
    {
        Yii::$app->settings->set('system', 'adminEmail', 'admin@mail.com');
        $this->assertTrue(Yii::$app->settings->has('system', 'adminEmail'));
        $this->assertFalse(Yii::$app->settings->has('system', 'userEmail'));
    }

    public function testCheckStringSettingType()
    {
        Yii::$app->settings->set('system', 'adminEmail', 'admin@mail.com', SettingType::STRING_TYPE);
        $this->assertInternalType('string', Yii::$app->settings->get('system', 'adminEmail'));
    }

    public function testCheckIntegerSettingType()
    {
        Yii::$app->settings->set('system', 'pageSize', 10, SettingType::INTEGER_TYPE);
        $this->assertInternalType('int', Yii::$app->settings->get('system', 'pageSize'));
    }

    public function testCheckBooleanSettingType()
    {
        Yii::$app->settings->set('system', 'enableSighup', true, SettingType::BOOLEAN_TYPE);
        $this->assertInternalType('bool', Yii::$app->settings->get('system', 'enableSighup'));
    }

    public function testCheckFloatSettingType()
    {
        Yii::$app->settings->set('system', 'matchingPercent', 10.5, SettingType::FLOAT_TYPE);
        $this->assertInternalType('float', Yii::$app->settings->get('system', 'matchingPercent'));
    }

    public function testCheckNullSettingType()
    {
        Yii::$app->settings->set('system', 'language', null, SettingType::NULL_TYPE);
        $this->assertInternalType('null', Yii::$app->settings->get('system', 'language'));
    }
}