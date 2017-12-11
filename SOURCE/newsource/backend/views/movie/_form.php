<?php

use awesome\backend\widgets\AwsBaseHtml;
use yii\widgets\ActiveForm;
use kartik\datetime\DateTimePicker;
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
            <?= $form->field($model, 'name')->textInput(['maxlength' => 50]) ?>            
            <?= $form->field($model, 'short_description')->textInput(['maxlength' => 255]) ?>   
            
            <?= Html::img($model['image_path'], ['width' => '60px']); ?>
            <?= $form->field($model, 'image_path')->fileInput()?> 
            
            <?= $form->field($model, 'description')->widget(CKEditor::className(), [
                    'options' => ['rows' => 10],
                    'preset' => 'basic'
                ]) ?>  
           
            <?= $form->field($model, 'type')->dropDownList( 
                    [
                        1 => "Phim lẻ",
                        2 => "Phim bộ",
                    ]
                    )?>      
            <?= $form->field($model, 'end_time')->widget(DateTimePicker::classname(), [
        'language' => 'vi',
//        'datetime' => 'dd-MM-yyyy h:i:s',
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