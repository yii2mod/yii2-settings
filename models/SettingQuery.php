<?php

namespace yii2mod\settings\models;

use yii\db\ActiveQuery;
use yii2mod\settings\models\enumerables\SettingStatus;

/**
 * Class SettingQuery
 * @package yii2mod\settings\models
 */
class SettingQuery extends ActiveQuery
{
    /**
     * Scope for settings with active status
     * @return $this
     */
    public function active()
    {
        $this->andWhere(['status' => SettingStatus::ACTIVE]);
        return $this;
    }

    /**
     * Scope for settings with inactive status
     * @return $this
     */
    public function inactive()
    {
        $this->andWhere(['status' => SettingStatus::INACTIVE]);
        return $this;
    }
}