<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SensorSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sensor-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'module_id') ?>

    <?= $form->field($model, 'cam_bien_dan_thu') ?>

    <?= $form->field($model, 'cam_bien_bon_solar') ?>

    <?= $form->field($model, 'cam_bien_muc_nuoc_bon_solar') ?>

    <?php // echo $form->field($model, 'cam_bien_nhiet_do_bon_gia_nhiet') ?>

    <?php // echo $form->field($model, 'cam_bien_ap_suat_bon_gia_nhiet') ?>

    <?php // echo $form->field($model, 'cam_bien_ap_suat_duong_ong') ?>

    <?php // echo $form->field($model, 'cam_bien_nhiet_do_duong_ong') ?>

    <?php // echo $form->field($model, 'cam_bien_nhiet_dinh_bon_solar') ?>

    <?php // echo $form->field($model, 'cam_bien_tran') ?>

    <?php // echo $form->field($model, 'du_phong') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('backend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
