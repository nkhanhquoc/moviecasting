<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use backend\models\Product;

/* @var $this yii\web\View */
/* @var $model backend\models\MenuSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="menu-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    

    <?= $form->field($model, 'MSISDN') ?>
<?php // echo "<pre>";print_r( $model->getVasService());die();?>
    <?php echo $form->field($model, 'PRODUCT_CODE')->dropDownList(                    
                        Product::getAllProduct(),['prompt'=>'Tất cả']                   
            ) ?>

   <?php echo $form->field($model, 'ENDPOINT')->dropDownList(                    
 \backend\models\Services::getAllServiceCode(),['prompt'=>'Tất cả']                    
            ) ?>

    <?php // echo $form->field($model, 'STATUS') ?>
    <?= $form->field($model, 'ERROR_CODE')->dropDownList(
                    [
                        0 => "Thành công",
                        18 => "Tài khoản không đủ",
                        22 => "Không được sd dv",
                    ],
                    ['prompt'=>'Tất cả']
                )?>
    <div class="form-group">
        <lablel class="control-label">Từ ngày</lablel>
    <?= yii\jui\DatePicker::widget([
                            'name' => 'LogTransactionSearch[created_time_from]',
                            'dateFormat' => 'php:Y-m-d',
                            'language' => 'vi',
                            'value' => \yii\helpers\Html::encode($fromTime),
                            'options' => [
                                'readonly' => 'readonly',
                                'class' =>'form-control'
                            ],
                        ]) ?>
        <div class="help-block"></div>
        <lablel class="control-label">Đến ngày</lablel>
    <?=
                        yii\jui\DatePicker::widget([
                            'name' => 'LogTransactionSearch[created_time_to]',
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