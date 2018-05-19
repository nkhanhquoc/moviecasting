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

    <?= $form->field($model, 'name',[ 'options' => ['style' => 'width: 50%;float:left']]) ?>
    <?= $form->field($model, 'blacklist_note',[ 'options' => ['style' => 'width: 50%;float:left']]) ?>
    <br>
    <?= $form->field($model, 'star',[ 'options' => ['style' => 'width: 50%;float:left']])->dropDownList([
                     1 => "1 Sao",
                2 => "2 Sao",
                3 => "3 Sao",
                4 => "4 Sao",
                5 => "5 Sao"],
                    ['prompt'=>'Tất cả']
                ) ?>
    
    <?= $form->field($model, 'casting_id',[ 'options' => ['style' => 'width: 50%;float:left']])->dropDownList(
                    $model->getAllCasting(),
                    ['prompt'=>'Tất cả']
                )?>
    <br>
    <div class="form-group">
        <lablel class="control-label">Ngày tạo từ</lablel>
        <br>
    <?= yii\jui\DatePicker::widget([
                            'name' => 'RegisterSearch[end_time_from]',
                            'dateFormat' => 'php:Y-m-d',
                            'language' => 'vi',
                            'value' => \yii\helpers\Html::encode($fromTime),
                            'options' => [
                                'readonly' => 'readonly',
                                'class' =>'form-control',
                               
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
                                'class' =>'form-control',
                                
                            ],
                        ])
                        ?>
        
    </div>
    
    <?= $form->field($model, 'chest_from',[ 'options' => ['style' => 'width: 50%;float:left']]) ?>
    <?= $form->field($model, 'chest_to',[ 'options' => ['style' => 'width: 50%;float:left']]) ?>
        <br>
    <?= $form->field($model, 'waist_from',[ 'options' => ['style' => 'width: 50%;float:left']]) ?>
    <?= $form->field($model, 'waist_to',[ 'options' => ['style' => 'width: 50%;float:left']]) ?>
        <br>
    <?= $form->field($model, 'butt_from',[ 'options' => ['style' => 'width: 50%;float:left']]) ?>
    <?= $form->field($model, 'butt_to',[ 'options' => ['style' => 'width: 50%;float:left']]) ?>
    <br>
    <?= $form->field($model, 'height_from',[ 'options' => ['style' => 'width: 50%;float:left']]) ?>
    <?= $form->field($model, 'height_to',[ 'options' => ['style' => 'width: 50%;float:left']]) ?>
    <br>
    <?= $form->field($model, 'weight_from',[ 'options' => ['style' => 'width: 50%;float:left']]) ?>
    <?= $form->field($model, 'weight_to',[ 'options' => ['style' => 'width: 50%;float:left']]) ?>
    
    
    
    
    
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
