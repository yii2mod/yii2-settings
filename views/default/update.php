<?php

use yii\helpers\Html;

$this->title = 'Update Setting: ' . $model->section . '.' . $model->key;
$this->params['breadcrumbs'][] = ['label' => 'Settings', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Update';

?>
<div class="setting-update">

    <h1><?php echo Html::encode($this->title) ?></h1>

    <?php echo $this->render('_form', [
        'model' => $model,
    ]);
    ?>

</div>
