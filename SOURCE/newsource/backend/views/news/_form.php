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
            <?= $form->field($model, 'title')->textInput(['maxlength' => 50]) ?>
            <?= Html::img($model['image_path'], ['width' => '60px']); ?>
            <?= $form->field($model, 'image_path')->fileInput()?> 
            <?= $form->field($model, 'description')->textarea(['rows' => 2]) ?>  
            
            <?= $form->field($model, 'content')->widget(CKEditor::className(), [
                    'options' => ['rows' => 10],
                    'preset' => 'basic'
                ]) ?>  
           
            <?= $form->field($model, 'status')->checkBox()?>      
          
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

