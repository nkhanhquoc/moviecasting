<?php

/* @var $this yii\web\View */
/* @var $form awesome\backend\form\AwsActiveForm */
/* @var $model \backend\models\ResetPasswordForm */


use awesome\backend\form\AwsActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;

$this->title = Yii::t('backend', 'Reset Password');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="pull-left lock-avatar-block">
    <img src="/img/photo3.jpg" class="lock-avatar">
</div>
<?php $form = AwsActiveForm::begin(['id' => 'change-password-form', 'options' => [
    'class' => 'lock-form pull-left'
]]); ?>
<?= $form->field($model, 'username')->textInput([
    "class" => "form-control",
    "autocomplete" => "off",
    "disabled" => "disabled"
]); ?>
<?= $form->field($model, 'password')->passwordInput([
    "class" => "form-control",
    "autocomplete" => "off",
]); ?>
<?= $form->field($model, 're_password')->passwordInput([
    "class" => "form-control",
    "autocomplete" => "off",
]); ?>
<?= $form->field($model, 'captcha')->widget(Captcha::className(), [
    'template' => '{input} {image}',
    'options' => [
        "class" => 'form-control',
        "autocomplete" => "off",
        "style" => "float:left; width:100px;"
    ],
]); ?>
<div class="form-actions noborder">
    <?= Html::submitButton(Yii::t('backend', 'Confirm'), ['class' => 'btn red uppercase', 'name' => 'login-button']) ?>
</div>
<?php AwsActiveForm::end(); ?>
