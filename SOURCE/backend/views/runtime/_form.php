<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\RuntimeStatistics */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="runtime-statistics-form">

    <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($model, 'module_id')->textInput(['maxlength' => 11]) ?>

    <?= $form->field($model, 'time_bom_doi_luu_1')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'time_bom_doi_luu_2')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'time_chay_bom_cap_nuoc_lanh_1')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'time_chay_bom_cap_nuoc_lanh_2')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'time_chay_bom_hoi_duong_ong_1')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'time_chay_bom_hoi_duong_ong_2')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'time_chay_bom_tang_ap_1')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'time_chay_bom_tang_ap_2')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'time_chay_bom_nhiet_bon_gia_nhiet_1')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'time_chay_bom_nhiet_bon_gia_nhiet_2')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'time_chay_van_dien_tu_ba_nga')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'time_chay_van_dien_tu_mot_chieu')->textInput(['maxlength' => 50]) ?>

    <?= $form->field($model, 'du_phong')->textInput(['maxlength' => 50]) ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
