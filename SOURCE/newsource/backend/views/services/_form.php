<?php

use awesome\backend\widgets\AwsBaseHtml;
use yii\widgets\ActiveForm;
use backend\models\Menu;
use kartik\select2\Select2;
use mdm\admin\AutocompleteAsset;
use yii\helpers\Json;
use yii\web\JsExpression;
use yii\web\View;
use kartik\datetime\DateTimePicker;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use xj\uploadify\Uploadify;
use yii\helpers\Url;
use backend\models\Category;

/* @var $this yii\web\View */
/* @var $model backend\models\Menu */
/* @var $title string */
/* @var $form AwsActiveForm */
//var_dump($categoryData);
//var_dump($category);
//die;
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
            <?= $form->field($model, 'CODE')->textInput(['maxlength' => 50]) ?>
            <?= $form->field($model, 'SERVICE')->textInput(['maxlength' => 50]) ?>            
            <?= $form->field($model, 'USERNAME')->textInput(['maxlength' => 50]) ?>
            <?= $form->field($model, 'URL')->textInput(['maxlength' => 50]) ?>
            <?= $form->field($model, 'PASSWORD')->textInput(['maxlength' => 50]) ?>
            <?= $form->field($model, 'REQUEST')->textInput(['maxlength' => 1000]) ?>
            <?= $form->field($model, 'RESPONSE')->textInput(['maxlength' => 50]) ?>
              
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

<?php
//AutocompleteAsset::register($this);
//$options1 = Json::htmlEncode([
//    'source' => Menu::find()->select(['name'])->column()
//]);
//$this->registerJs("$('#parent_name').autocomplete($options1);");
//
//$options2 = Json::htmlEncode([
//    'source' => Menu::getSavedRoutes()
//]);
//$this->registerJs("$('#route').autocomplete($options2);");