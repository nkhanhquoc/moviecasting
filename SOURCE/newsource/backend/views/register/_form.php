<?php

use awesome\backend\widgets\AwsBaseHtml;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Menu */
/* @var $title string */
/* @var $form AwsActiveForm */

?>

<?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

<div class="portlet light portlet-fit portlet-form bordered menu-form">
    <div class="portlet-title">
        <div class="caption">
            <i class="icon-paper-plane "></i>
<!--                <span class="caption-subject sbold uppercase">
                </span>-->
        </div>

    </div>
    <div class="portlet-body">
        <div class="form-body">
            <?= $form->field($model, 'name')->textInput(['disabled' => true]) ?>
            <?= $form->field($model, 'castingName')->textInput(['disabled' => true]) ?>
            <?= $form->field($model, 'genreName')->textInput(['disabled' => true]) ?>
            <?= $form->field($model, 'birth_year')->textInput(['disabled' => true]) ?>
            <?= $form->field($model, 'msisdn')->textInput(['disabled' => true]) ?>
            <?= $form->field($model, 'location')->textInput(['disabled' => true]) ?>
            <label class="control-label" for="register-outfit">Hình ảnh</label> 
             <?= Html::img($model['outfit'], ['width' => '60px']); ?>
            <br>
            <?= $form->field($model, 'height')->textInput(['disabled' => true]) ?>
            <?= $form->field($model, 'weight')->textInput(['disabled' => true]) ?>
            <?= $form->field($model, 'sodo')->textInput(['disabled' => true]) ?>
            <?= $form->field($model, 'portrait')->textInput(['disabled' => true]) ?>
            <?= $form->field($model, 'facebook')->textInput(['disabled' => true]) ?>
            <?= $form->field($model, 'product')->textarea(['disabled' => true,'rows'=>10]) ?>
            <?= $form->field($model, 'status')->checkBox(['disabled' => true]) ?>
            <?= $form->field($model, 'star')->dropDownList([
                1 => "1 Sao",
                2 => "2 Sao",
                3 => "3 Sao",
                4 => "4 Sao",
                5 => "5 Sao",
            ]) ?>
            
        </div>
    </div>
    <div class="portlet-title">
        <div class="actions">
            <?= AwsBaseHtml::submitButton($model->isNewRecord ? Yii::t('backend', 'Create') : Yii::t('backend', 'Update'), ['class' => 'btn btn-info  btn-outline btn-circle btn-sm','id' => 'frm-btn-submit']) ?>
            <button type="button" name="back" class="btn btn-transparent black btn-outline btn-circle btn-sm"
                    onclick="history.back(-1);">
                <i class="fa fa-angle-left"></i> Quay lại
            </button>
        </div>
    </div>

</div>

<?php ActiveForm::end(); ?>

