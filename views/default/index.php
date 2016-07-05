<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\widgets\Pjax;
use yii2mod\editable\EditableColumn;
use yii2mod\settings\models\enumerables\SettingStatus;
use yii2mod\settings\models\enumerables\SettingType;
use yii2mod\settings\models\SettingModel;

/* @var $dataProvider \yii\data\ActiveDataProvider */
/* @var $searchModel \yii2mod\settings\models\search\SettingModelSearch */
$this->title = Yii::t('app', 'Settings');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="setting-index">
    <h1><?php echo Html::encode($this->title) ?></h1>

    <p><?php echo Html::a('Create Setting', ['create'], ['class' => 'btn btn-success']); ?></p>
    <?php Pjax::begin(['timeout' => 10000, 'enablePushState' => false]); ?>
    <?php echo GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'class' => 'yii\grid\SerialColumn',
                ],
                'id',
                [
                    'attribute' => 'type',
                    'filter' => SettingType::listData(),
                    'filterInputOptions' => ['prompt' => 'Select type', 'class' => 'form-control']
                ],
                [
                    'attribute' => 'section',
                    'filter' => ArrayHelper::map(SettingModel::find()->select('section')->distinct()->all(), 'section', 'section'),
                    'filterInputOptions' => ['prompt' => 'Select section', 'class' => 'form-control']
                ],
                'key',
                'value:ntext',
                [
                    'class' => EditableColumn::className(),
                    'attribute' => 'status',
                    'url' => ['edit-setting'],
                    'value' => function ($model) {
                        return SettingStatus::getLabel($model->status);
                    },
                    'type' => 'select',
                    'editableOptions' => function ($model) {
                        return [
                            'source' => SettingStatus::listData(),
                            'value' => $model->status,
                        ];
                    },
                    'filter' => SettingStatus::listData(),
                    'filterInputOptions' => ['prompt' => 'Select Status', 'class' => 'form-control'],
                ],
                [
                    'header' => 'Actions',
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update}{delete}',
                ],
            ],
        ]
    ); ?>
    <?php Pjax::end(); ?>
</div>
