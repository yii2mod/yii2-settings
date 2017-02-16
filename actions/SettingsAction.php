<?php

namespace yii2mod\settings\actions;

use Yii;
use yii\base\Action;
use yii\base\InvalidConfigException;
use yii\helpers\ArrayHelper;
use yii2mod\settings\events\FormEvent;

/**
 * Class SettingsAction
 *
 * @package yii2mod\settings\actions
 */
class SettingsAction extends Action
{
    /**
     * Event is triggered before the settings will be saved.
     * Triggered with \yii2mod\settings\events\FormEvent.
     */
    const EVENT_BEFORE_SAVE = 'beforeSave';

    /**
     * Event is triggered after the settings have been saved successfully.
     * Triggered with \yii2mod\settings\events\FormEvent.
     */
    const EVENT_AFTER_SAVE = 'afterSave';

    /**
     * @var string class name of the model which will be used to validate the attributes
     */
    public $modelClass;

    /**
     * @var string message to be set on successful save a model
     */
    public $successMessage = 'Settings have been saved successfully.';

    /**
     * @var string the name of the settings view
     */
    public $view = 'settings';

    /**
     * @var array additional view params
     */
    public $viewParams = [];

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        if ($this->modelClass === null) {
            throw new InvalidConfigException('The "modelClass" property must be set.');
        }
    }

    /**
     * Renders the settings form.
     *
     * @return string
     */
    public function run()
    {
        $model = Yii::createObject($this->modelClass);
        $event = Yii::createObject(['class' => FormEvent::class, 'form' => $model]);

        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            $this->trigger(self::EVENT_BEFORE_SAVE, $event);

            foreach ($model->toArray() as $key => $value) {
                Yii::$app->settings->set($model->formName(), $key, $value);
            }

            $this->trigger(self::EVENT_AFTER_SAVE, $event);

            if ($this->successMessage !== null) {
                Yii::$app->session->setFlash('success', $this->successMessage);
            }
        }

        foreach ($model->attributes() as $attribute) {
            $model->{$attribute} = Yii::$app->settings->get($model->formName(), $attribute);
        }

        return $this->controller->render($this->view, ArrayHelper::merge($this->viewParams, [
            'model' => $model,
        ]));
    }
}
