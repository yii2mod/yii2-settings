<?php

namespace yii2mod\settings\events;

use yii\base\Event;
use yii\base\Model;

/**
 * Class FormEvent
 *
 * @package yii2mod\settings\events
 */
class FormEvent extends Event
{
    /**
     * @var Model
     */
    private $_form;

    /**
     * @return Model
     */
    public function getForm(): Model
    {
        return $this->_form;
    }

    /**
     * @param Model $form
     */
    public function setForm(Model $form)
    {
        $this->_form = $form;
    }
}
