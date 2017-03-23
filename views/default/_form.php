<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii2mod\settings\models\enumerables\SettingStatus;
use yii2mod\settings\models\enumerables\SettingType;

/* @var $this \yii\web\View */
/* @var $model \yii2mod\settings\models\SettingModel */
?>

<div class="setting-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'section')->textInput(['maxlength' => 255]); ?>
    <?php echo $form->field($model, 'key')->textInput(['maxlength' => 255]); ?>
    <?php echo $form->field($model, 'value')->textarea(['rows' => 5]); ?>
    <?php echo $form->field($model, 'description')->textarea(['rows' => 5]); ?>
    <?php echo $form->field($model, 'status')->dropDownList(SettingStatus::listData()); ?>
    <?php echo $form->field($model, 'type')->dropDownList(SettingType::listData()); ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? Yii::t('yii2mod.settings', 'Create') : Yii::t('yii2mod.settings', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>
        <?php echo Html::a(Yii::t('yii2mod.settings', 'Go Back'), ['index'], ['class' => 'btn btn-default']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
