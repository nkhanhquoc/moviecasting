<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\OutputMode */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="output-mode-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'module_id')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'convection_pump')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'cold_water_supply_pump')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'return_pump')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'incresed_pressure_pump')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'heat_pump')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'heater_resister')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'three_way_valve')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'backflow_valve')->textInput(['maxlength' => 255]) ?>

    <?= $form->field($model, 'reserved')->textInput(['maxlength' => 255]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
