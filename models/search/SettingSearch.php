<?php

namespace yii2mod\settings\models\search;

use yii\data\ActiveDataProvider;
use yii2mod\settings\models\SettingModel;

/**
 * Class SettingSearch
 * @package yii2mod\settings\models\search
 */
class SettingSearch extends SettingModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'section', 'key', 'value', 'status'], 'safe'],
        ];
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = self::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10
            ]
        ]);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        $query->andFilterWhere(['status' => $this->status]);
        $query->andFilterWhere(['section' => $this->section]);
        $query->andFilterWhere(['type' => $this->type]);
        $query->andFilterWhere(['like', 'key', $this->key]);
        $query->andFilterWhere(['like', 'value', $this->value]);

        return $dataProvider;
    }
}