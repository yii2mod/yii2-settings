<?php

namespace yii2mod\settings\models\search;

use Yii;
use yii\data\ActiveDataProvider;
use yii2mod\settings\models\SettingModel;

/**
 * Class SettingSearch
 * @package yii2mod\settings\models\search
 */
class SettingModelSearch extends SettingModel
{
    /**
     * Returns the validation rules for attributes.
     * @return array validation rules
     */
    public function rules()
    {
        return [
            [['id', 'type', 'section', 'key', 'value', 'status'], 'safe'],
        ];
    }

    /**
     * Setup search function for filtering and sorting
     * based on fullName field
     * @param $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = SettingModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['id' => $this->id]);
        $query->andFilterWhere(['status' => $this->status]);
        $query->andFilterWhere(['section' => $this->section]);
        $query->andFilterWhere(['type' => $this->type]);
        $query->andFilterWhere(['like', 'key', $this->key]);
        $query->andFilterWhere(['like', 'value', $this->value]);

        return $dataProvider;
    }
}
