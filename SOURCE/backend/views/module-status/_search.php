<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\ModuleStatusSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="module-status-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'module_id') ?>

    <?= $form->field($model, 'bom_doi_luu_1') ?>

    <?= $form->field($model, 'bom_doi_luu_2') ?>

    <?= $form->field($model, 'bom_cap_nuoc_lanh_1') ?>

    <?php // echo $form->field($model, 'bom_cap_nuoc_lanh_2') ?>

    <?php // echo $form->field($model, 'bom_hoi_duong_ong_1') ?>

    <?php // echo $form->field($model, 'bom_hoi_duong_ong_2') ?>

    <?php // echo $form->field($model, 'bom_tang_ap_1') ?>

    <?php // echo $form->field($model, 'bom_tang_ap_2') ?>

    <?php // echo $form->field($model, 'bom_ha_nhiet_bon_gia_nhiet_1') ?>

    <?php // echo $form->field($model, 'bom_ha_nhiet_bon_gia_nhiet_2') ?>

    <?php // echo $form->field($model, 'van_dien_tu_ba_nga') ?>

    <?php // echo $form->field($model, 'van_dien_tu_mot_chieu') ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('backend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
