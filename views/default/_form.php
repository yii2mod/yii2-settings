<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii2mod\settings\models\enumerables\SettingStatus;
use yii2mod\settings\models\enumerables\SettingType;

?>

<div class="setting-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php echo $form->field($model, 'section')->textInput(['maxlength' => 255]) ?>
    <?php echo $form->field($model, 'key')->textInput(['maxlength' => 255]) ?>
    <?php echo $form->field($model, 'value')->textInput(['maxlength' => 255]) ?>
    <?php echo $form->field($model, 'status')->dropDownList(SettingStatus::listData()); ?>
    <?php echo $form->field($model, 'type')->dropDownList(SettingType::listData()); ?>

    <div class="form-group">
        <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']); ?>
        <?php echo Html::a('Cancel', ['index'], ['class' => 'btn btn-default']); ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
