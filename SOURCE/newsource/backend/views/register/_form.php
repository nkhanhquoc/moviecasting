<?php

use awesome\backend\widgets\AwsBaseHtml;
use yii\widgets\ActiveForm;
use dosamigos\ckeditor\CKEditor;
use yii\helpers\Html;
use kartik\date\DatePicker;
//use kartik\datetime\DateTimePicker;

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
            <?= $form->field($model, 'casting_id')->dropDownList(
                    $model->getAllCasting()
                    ) ?>
            <?= $form->field($model, 'genre')->dropDownList([
                1 => "Nam",
                2 => "Nữ"
            ]) ?>
            <?= $form->field($model, 'birth_year')->widget(DatePicker::classname(), [
        'language' => 'vi',
        'pluginOptions' => [
            'format' => 'dd-mm-yyyy',
            'todayHighlight' => true
        ]
    ]) ?>
            <?= $form->field($model, 'msisdn')->textInput(['maxlength' => 50]) ?>
            <?= $form->field($model, 'location')->textInput(['maxlength' => 50]) ?>
            
            <?= $form->field($model, 'height')->textInput(['maxlength' => 4]) ?>
            <?= $form->field($model, 'weight')->textInput(['maxlength' => 4]) ?>
            <?= $form->field($model, 'chest')->textInput(['maxlength' => 50]) ?>
            <?= $form->field($model, 'waist')->textInput(['maxlength' => 50]) ?>
            <?= $form->field($model, 'butt')->textInput(['maxlength' => 50]) ?>
            
            <?= Html::img($model['portrait'], ['width' => '60px']); ?>
            <?= $form->field($model, 'portrait')->fileInput()?>
            <?= Html::img($model['portrait_2'], ['width' => '60px']); ?>
            <?= $form->field($model, 'portrait_2')->fileInput()?>
            <?= Html::img($model['portrait_3'], ['width' => '60px']); ?>
            <?= $form->field($model, 'portrait_3')->fileInput()?>
            
            <?= $form->field($model, 'facebook')->textInput(['maxlength' => 50]) ?>
            <?= $form->field($model, 'product')->textarea(['rows'=>10]) ?>
            <?= $form->field($model, 'status')->checkBox() ?>
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

