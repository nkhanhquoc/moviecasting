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
    <?= $form->field($model, 'movie_id')->dropDownList(
                    $model->getAllMovie(),
                    ['prompt'=>'Tất cả']
                )?>
    <div class="form-group">
        <lablel class="control-label">Ngày tạo từ</lablel>
    <?= yii\jui\DatePicker::widget([
                            'name' => 'CastingSearch[end_time_from]',
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
                            'name' => 'CastingSearch[end_time_to]',
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

    <div class="form-group">
        <?= Html::submitButton(Yii::t('backend', 'Search'), ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton(Yii::t('backend', 'Reset'), ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
