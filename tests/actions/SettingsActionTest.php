<?php

namespace yii2mod\settings\tests\actions;

use Yii;
use yii\base\Model;
use yii2mod\settings\actions\SettingsAction;
use yii2mod\settings\tests\data\ConfigurationForm;
use yii2mod\settings\tests\TestCase;

class SettingsActionTest extends TestCase
{
    /**
     * @expectedException \yii\base\InvalidConfigException
     */
    public function testCheckIncorrectConfig()
    {
        $this->runAction();
    }

    public function testCheckValidation()
    {
        Yii::$app->request->bodyParams = [
            'ConfigurationForm' => [],
        ];

        $response = $this->runAction(['modelClass' => ConfigurationForm::class]);
        $this->assertTrue($response['params']['model']->hasErrors());
    }

    public function testSaveSettingsSuccess()
    {
        Yii::$app->request->setUrl('index');
        Yii::$app->request->bodyParams = [
            'ConfigurationForm' => [
                'appName' => 'my-app',
                'adminEmail' => 'admin@example.org',
            ],
        ];

        $response = $this->runAction(['modelClass' => ConfigurationForm::class]);

        $this->assertEquals($response->getStatusCode(), 302);
        $this->assertTrue(Yii::$app->settings->has('ConfigurationForm', 'appName'));
        $this->assertTrue(Yii::$app->settings->has('ConfigurationForm', 'adminEmail'));
        $this->assertEquals(Yii::$app->settings->get('ConfigurationForm', 'appName'), 'my-app');
        $this->assertEquals(Yii::$app->settings->get('ConfigurationForm', 'adminEmail'), 'admin@example.org');
    }

    public function testSetPrepareModelCallback()
    {
        $response = $this->runAction([
            'modelClass' => ConfigurationForm::class,
            'prepareModel' => function ($model) {
                foreach ($model->attributes() as $attribute) {
                    $model->{$attribute} = 'test-value';
                }
            },
        ]);

        $this->assertEquals($response['params']['model']->appName, 'test-value');
        $this->assertEquals($response['params']['model']->adminEmail, 'test-value');
    }

    public function testSaveSettingsCallback()
    {
        $form = new ConfigurationForm();

        Yii::$app->request->setUrl('index');
        Yii::$app->request->bodyParams = [
            'ConfigurationForm' => [
                'appName' => 'my-app',
                'adminEmail' => 'admin@example.org',
            ],
        ];

        $this->runAction([
            'modelClass' => ConfigurationForm::class,
            'saveSettings' => function (Model $model) {
                foreach ($model->toArray() as $key => $value) {
                    Yii::$app->settings->set(get_class($model), $key, $value);
                }
            },
        ]);

        $this->assertEquals(Yii::$app->settings->get(get_class($form), 'appName'), 'my-app');
        $this->assertEquals(Yii::$app->settings->get(get_class($form), 'adminEmail'), 'admin@example.org');
    }

    /**
     * Runs the action.
     *
     * @param array $config
     *
     * @return string
     */
    protected function runAction(array $config = [])
    {
        $action = new SettingsAction('settings', $this->createController(), $config);

        return $action->run();
    }
}
