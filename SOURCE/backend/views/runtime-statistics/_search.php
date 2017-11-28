<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RuntimeStatisticsSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="runtime-statistics-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'module_id') ?>

    <?= $form->field($model, 'time_bom_doi_luu_1') ?>

    <?= $form->field($model, 'time_bom_doi_luu_2') ?>

    <?= $form->field($model, 'time_chay_bom_cap_nuoc_lanh_1') ?>

    <?php // echo $form->field($model, 'time_chay_bom_cap_nuoc_lanh_2') ?>

    <?php // echo $form->field($model, 'time_chay_bom_hoi_duong_ong_1') ?>

    <?php // echo $form->field($model, 'time_chay_bom_hoi_duong_ong_2') ?>

    <?php // echo $form->field($model, 'time_chay_bom_tang_ap_1') ?>

    <?php // echo $form->field($model, 'time_chay_bom_tang_ap_2') ?>

    <?php // echo $form->field($model, 'time_chay_bom_nhiet_bon_gia_nhiet_1') ?>

    <?php // echo $form->field($model, 'time_chay_bom_nhiet_bon_gia_nhiet_2') ?>

    <?php // echo $form->field($model, 'time_chay_van_dien_tu_ba_nga') ?>

    <?php // echo $form->field($model, 'time_chay_van_dien_tu_mot_chieu') ?>

    <?php // echo $form->field($model, 'du_phong') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('backend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
