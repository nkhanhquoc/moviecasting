<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Sensor */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sensor-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'module_id')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'cam_bien_dan_thu')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'cam_bien_bon_solar')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'cam_bien_muc_nuoc_bon_solar')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'cam_bien_nhiet_do_bon_gia_nhiet')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'cam_bien_ap_suat_bon_gia_nhiet')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'cam_bien_ap_suat_duong_ong')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'cam_bien_nhiet_do_duong_ong')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'cam_bien_nhiet_dinh_bon_solar')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'cam_bien_tran')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'du_phong')->textInput(['maxlength' => 50]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
