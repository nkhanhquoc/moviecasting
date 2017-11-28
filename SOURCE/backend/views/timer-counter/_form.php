<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TimerCounter */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="timer-counter-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'module_id')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'counter')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'timer_1')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'timer_2')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'timer_3')->textInput(['maxlength' => 50]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
