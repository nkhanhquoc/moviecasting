<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OutputModeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="output-mode-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'module_id') ?>

    <?= $form->field($model, 'convection_pump') ?>

    <?= $form->field($model, 'cold_water_supply_pump') ?>

    <?= $form->field($model, 'return_pump') ?>

    <?php // echo $form->field($model, 'incresed_pressure_pump') ?>

    <?php // echo $form->field($model, 'heat_pump') ?>

    <?php // echo $form->field($model, 'heater_resister') ?>

    <?php // echo $form->field($model, 'three_way_valve') ?>

    <?php // echo $form->field($model, 'backflow_valve') ?>

    <?php // echo $form->field($model, 'reserved') ?>

    <?php // echo $form->field($model, 'updated_at') ?>

    <?php // echo $form->field($model, 'updated_by') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'created_by') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('backend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
