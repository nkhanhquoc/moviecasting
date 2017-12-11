<?php

/* @var $this yii\web\View */
/* @var $form awesome\backend\form\AwsActiveForm */
/* @var $model \backend\models\LoginForm */

use awesome\backend\form\AwsActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;

$this->title = Yii::t('backend', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="pull-left lock-avatar-block">
    <img src="/img/photo3.jpg" class="lock-avatar">
</div>
<?php $form = AwsActiveForm::begin(['id' => 'login-form', 'options' => [
    'class' => 'lock-form pull-left'
]]); ?>
<?= $form->field($model, 'username')->textInput([
    "class" => "form-control",
    "autocomplete" => "off",
//    "placeholder" => Html::encode(Yii::t('backend', "Username"))
]); ?>
<?= $form->field($model, 'password')->passwordInput([
    "class" => "form-control",
    "autocomplete" => "off",
//    "placeholder" => Html::encode(Yii::t('backend', "Password"))
]); ?>
<?= $form->field($model, 'captcha')->widget(Captcha::className(), [
    'template' => '{input} {image}<span class="glyphicon glyphicon-refresh captcha-refresh-icon"></span>',
    'options' => [
        "class" => 'form-control',
        "autocomplete" => "off",
//        "placeholder" => Html::encode(Yii::t('backend', "Captcha")),
        "style" => "float:left; width:90px;"
    ],

]); ?>
<div class="form-actions noborder">
    <?= Html::submitButton('Login', ['class' => 'btn red uppercase', 'name' => 'login-button', "style" => "width:70px; float:left"]) ?>
    <?php
    /*
     <label class="rememberme check ">
        <?= $form->field($model, 'rememberMe')->checkbox([
            'label' => Html::encode(Yii::t('backend', "Remember Me"))
        ]) ?>
    </label>
     * */
    ?>

</div>
<?php AwsActiveForm::end(); ?>
