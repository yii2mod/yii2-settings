<?php

namespace yii2mod\settings\tests;

use Yii;
use yii2mod\settings\models\enumerables\SettingType;

/**
 * Class SettingsTest
 *
 * @package yii2mod\settings\tests
 */
class SettingsTest extends TestCase
{
    public function testNotExistingSetting()
    {
        $this->assertNull(Yii::$app->settings->get('admin', 'email'), 'Setting is exists!');
    }

    public function testSetAndGetSetting()
    {
        Yii::$app->settings->set('admin', 'email', 'admin@mail.com');
        $this->assertEquals('admin@mail.com', Yii::$app->settings->get('admin', 'email'), 'Wrong setting name!');
    }

    public function testGetAllSettingsBySection()
    {
        Yii::$app->settings->set('admin', 'email', 'admin@mail.com');
        Yii::$app->settings->set('admin', 'username', 'admin');
        Yii::$app->settings->set('admin', 'website', 'http://example.org');

        $settings = Yii::$app->settings->getAllBySection('admin');

        $this->assertCount(3, $settings, 'Wrong settings count!');
        $this->assertEquals( 'admin@mail.com', $settings['email']);
        $this->assertEquals( 'admin', $settings['username']);
        $this->assertEquals( 'http://example.org', $settings['website']);
        $this->assertNull(Yii::$app->settings->getAllBySection('not-existed'));
    }

    public function testRemoveSetting()
    {
        Yii::$app->settings->set('admin', 'email', 'admin@mail.com');
        $this->assertEquals('admin@mail.com', Yii::$app->settings->get('admin', 'email'), 'Wrong setting name!');
        Yii::$app->settings->remove('admin', 'email');
        $this->assertNull(Yii::$app->settings->get('admin', 'email'), 'Unable to remove the setting!');
    }

    public function testRemoveAllSettings()
    {
        Yii::$app->settings->set('admin', 'email', 'admin@mail.com');
        Yii::$app->settings->set('admin', 'password', '123123');

        $this->assertEquals(2, Yii::$app->settings->removeAll());
        $this->assertFalse(Yii::$app->settings->has('admin', 'email'));
        $this->assertFalse(Yii::$app->settings->has('admin', 'password'));
    }

    public function testSetSettingWithType()
    {
        Yii::$app->settings->set('cron', 'activeEmailCommand', 'false', SettingType::BOOLEAN_TYPE);
        $this->assertFalse(Yii::$app->settings->get('cron', 'activeEmailCommand'), 'Unable to set the setting!');
    }

    public function testHasSetting()
    {
        Yii::$app->settings->set('system', 'adminEmail', 'admin@mail.com');
        $this->assertTrue(Yii::$app->settings->has('system', 'adminEmail'), 'Added setting does not present in the storage!');
        $this->assertFalse(Yii::$app->settings->has('system', 'userEmail'), 'Not added setting present in the storage!');
    }

    public function testActivateAndDeactivateSetting()
    {
        Yii::$app->settings->set('app', 'catchAll', 'site/catchAll');
        $this->assertTrue(Yii::$app->settings->deactivate('app', 'catchAll'), 'Unable to deactivate the setting!');
        $this->assertTrue(Yii::$app->settings->activate('app', 'catchAll'), 'Unable to activate the setting!');
    }

    public function testCheckStringSettingType()
    {
        Yii::$app->settings->set('system', 'adminEmail', 'admin@mail.com', SettingType::STRING_TYPE);
        $this->assertInternalType('string', Yii::$app->settings->get('system', 'adminEmail'), 'Returned setting is not an string!');
    }

    public function testCheckIntegerSettingType()
    {
        Yii::$app->settings->set('system', 'pageSize', 10, SettingType::INTEGER_TYPE);
        $this->assertInternalType('int', Yii::$app->settings->get('system', 'pageSize'), 'Returned setting is not an integer!');
    }

    public function testCheckBooleanSettingType()
    {
        Yii::$app->settings->set('system', 'enableSighup', true, SettingType::BOOLEAN_TYPE);
        $this->assertInternalType('bool', Yii::$app->settings->get('system', 'enableSighup'), 'Returned setting is not an boolean!');
    }

    public function testCheckFloatSettingType()
    {
        Yii::$app->settings->set('system', 'matchingPercent', 10.5, SettingType::FLOAT_TYPE);
        $this->assertInternalType('float', Yii::$app->settings->get('system', 'matchingPercent'), 'Returned setting is not an float!');
    }

    public function testCheckNullSettingType()
    {
        Yii::$app->settings->set('system', 'language', null, SettingType::NULL_TYPE);
        $this->assertInternalType('null', Yii::$app->settings->get('system', 'language'), 'Returned setting is not an null!');
    }
}
