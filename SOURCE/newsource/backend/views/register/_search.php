<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Movie;

/* @var $this yii\web\View */
/* @var $model backend\models\MenuSearch */
/* @var $form yii\widgets\ActiveForm */


?>

<div class="menu-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>   

    <?= $form->field($model, 'name') ?>
    <?= $form->field($model, 'star')->dropDownList([
                     1 => "1 Sao",
                2 => "2 Sao",
                3 => "3 Sao",
                4 => "4 Sao",
                5 => "5 Sao"],
                    ['prompt'=>'Tất cả']
                ) ?>
    <?= $form->field($model, 'casting_id')->dropDownList(
                    $model->getAllCasting(),
                    ['prompt'=>'Tất cả']
                )?>
    <div class="form-group">
        <lablel class="control-label">Ngày tạo từ</lablel>
    <?= yii\jui\DatePicker::widget([
                            'name' => 'RegisterSearch[end_time_from]',
                            'dateFormat' => 'php:Y-m-d',
                            'language' => 'vi',
                            'value' => \yii\helpers\Html::encode($fromTime),
                            'options' => [
                                'readonly' => 'readonly',
                                'class' =>'form-control'
                            ],
                        ]) ?>
        <div class="help-block"></div>
        <lablel class="control-label">Ngày tạo đến</lablel>
    <?=
                        yii\jui\DatePicker::widget([
                            'name' => 'RegisterSearch[end_time_to]',
                            'dateFormat' => 'php:Y-m-d',
                            'language' => 'vi',
                            'value' => \yii\helpers\Html::encode($toTime),
                            'options' => [
                                'readonly' => 'readonly',
                                'class' =>'form-control'
                            ],
                        ])
                        ?>
        
    </div>
    
    <div style="display: inline;width: 300px;float:left;">
    <?= $form->field($model, 'chest_from',[ 'options' => ['style' => 'width: 120px']]) ?>
    <?= $form->field($model, 'chest_to',[ 'options' => ['style' => 'width: 120px']]) ?>
        </div>
    <?= $form->field($model, 'waist_from',[ 'options' => ['style' => 'width: 120px']]) ?>
    <?= $form->field($model, 'waist_to',[ 'options' => ['style' => 'width: 120px']]) ?>
    <?= $form->field($model, 'butt_from',[ 'options' => ['style' => 'width: 120px']]) ?>
    <?= $form->field($model, 'butt_to',[ 'options' => ['style' => 'width: 120px']]) ?>
    
    <?= $form->field($model, 'height_from',[ 'options' => ['style' => 'width: 120px']]) ?>
    <?= $form->field($model, 'height_to',[ 'options' => ['style' => 'width: 120px']]) ?>
    <?= $form->field($model, 'weight_from',[ 'options' => ['style' => 'width: 120px']]) ?>
    <?= $form->field($model, 'weight_to',[ 'options' => ['style' => 'width: 120px']]) ?>
    
    
    
    
    
     <div class="form-group">
        <lablel class="control-label">Năm sinh từ</lablel>
    <?= kartik\date\DatePicker::widget([
                            'name' => 'RegisterSearch[birth_year_from]',
                            'language' => 'vi',
                            'value' => \yii\helpers\Html::encode($fromTime),
                            'pluginOptions' => [
                                'format' => 'dd-mm-yyyy',
                                'readonly' => 'readonly',
                                'todayHighlight' => true
                            ]
                           
                        ]) ?>
        <div class="help-block"></div>
        <lablel class="control-label">Năm sinh đến</lablel>
    <?=
                        kartik\date\DatePicker::widget([
                            'name' => 'RegisterSearch[birth_year_to]',
                            'language' => 'vi',
                            'value' => \yii\helpers\Html::encode($toTime),
                            'pluginOptions' => [
                                'format' => 'dd-mm-yyyy',
                                'readonly' => 'readonly',
                                'todayHighlight' => true
                            ]
                        ])
                        ?>
        
    </div>  

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('backend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
