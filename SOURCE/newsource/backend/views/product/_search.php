<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MenuSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    

    <?= $form->field($model, 'NAME') ?>
<?php // echo "<pre>";print_r( $model->getVasService());die();?>
    <?php echo $form->field($model, 'VAS_SERVICE_ID')->dropDownList(                    
                        $model->getVasService(),['prompt'=>'Tất cả']                   
            ) ?>

   <?php echo $form->field($model, 'CATEGORY')->dropDownList(                    
 \backend\models\Category::getAllCategory(),['prompt'=>'Tất cả']                    
            ) ?>

    <?php // echo $form->field($model, 'STATUS') ?>
    <?= $form->field($model, 'STATUS')->dropDownList(
                    [
                        0 => "Hủy",
                        1 => "Kích hoạt",
                        2 => "Đã xử lý",
                    ],
                    ['prompt'=>'Tất cả']
                )?>
    <div class="form-group">
        <lablel class="control-label">Hết hạn từ</lablel>
    <?= yii\jui\DatePicker::widget([
                            'name' => 'ProductSearch[end_time_from]',
                            'dateFormat' => 'php:Y-m-d',
                            'language' => 'vi',
                            'value' => \yii\helpers\Html::encode($fromTime),
                            'options' => [
                                'readonly' => 'readonly',
                                'class' =>'form-control'
                            ],
                        ]) ?>
        <div class="help-block"></div>
        <lablel class="control-label">Hết hạn đến</lablel>
    <?=
                        yii\jui\DatePicker::widget([
                            'name' => 'ProductSearch[end_time_to]',
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
