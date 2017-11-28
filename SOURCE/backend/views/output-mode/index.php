<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\widgets\AwsGridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\OutputModeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Output Modes');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="output-mode-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?=
        Html::a(Yii::t('backend', 'Create {modelClass}', [
                    'modelClass' => 'Output Mode',
                ]), ['create'], ['class' => 'btn btn-success'])
        ?>
    </p>
    <?php
    Pjax::begin(['formSelector' => 'form', 'enablePushState' => false]);
    ?>
    <?=
    AwsGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'label' => 'Module',
                'content' => function ($data) {
                    return Html::encode($data->module->name);
                },
                'filter' => backend\models\Modules::getAll()
            ],
            'convection_pump',
            'cold_water_supply_pump',
            'return_pump',
            'incresed_pressure_pump',
            'heat_pump',
            'heater_resister',
            'three_way_valve',
            'backflow_valve',
            'reserved',
            // 'updated_at',
            // 'updated_by',
            // 'created_at',
            // 'created_by',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php
    Pjax::end();
    ?>
</div>
