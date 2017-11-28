<?php

use backend\models\SensorSearch;
use yii\data\ActiveDataProvider;
use yii\grid\GridView;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Pjax;

/* @var $this View */
/* @var $searchModel SensorSearch */
/* @var $dataProvider ActiveDataProvider */

$this->title = Yii::t('backend', 'Sensors');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sensor-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?=
        Html::a(Yii::t('backend', 'Create {modelClass}', [
                    'modelClass' => 'Sensor',
                ]), ['create'], ['class' => 'btn btn-success'])
        ?>
    </p>
    <?php
    Pjax::begin(['formSelector' => 'form', 'enablePushState' => false]);
    ?>
    <?=
    GridView::widget([
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
            'cam_bien_dan_thu',
            'cam_bien_bon_solar',
            'cam_bien_muc_nuoc_bon_solar',
            'cam_bien_nhiet_do_bon_gia_nhiet',
            'cam_bien_ap_suat_bon_gia_nhiet',
            'cam_bien_ap_suat_duong_ong',
            'cam_bien_nhiet_do_duong_ong',
            'cam_bien_nhiet_dinh_bon_solar',
            'cam_bien_tran',
            // 'du_phong',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php
    Pjax::end();
    ?>
</div>
