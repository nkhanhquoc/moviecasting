<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\widgets\AwsGridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\RuntimeStatisticsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Runtime Statistics');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="runtime-statistics-index">
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <p>
        <?= Html::a(Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Runtime Statistics',
]), ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php 
    Pjax::begin(['formSelector' => 'form', 'enablePushState' => false]);
    ?>
            <?= AwsGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

                    'id',
            'module_id',
            'time_bom_doi_luu_1',
            'time_bom_doi_luu_2',
            'time_chay_bom_cap_nuoc_lanh_1',
            // 'time_chay_bom_cap_nuoc_lanh_2',
            // 'time_chay_bom_hoi_duong_ong_1',
            // 'time_chay_bom_hoi_duong_ong_2',
            // 'time_chay_bom_tang_ap_1',
            // 'time_chay_bom_tang_ap_2',
            // 'time_chay_bom_nhiet_bon_gia_nhiet_1',
            // 'time_chay_bom_nhiet_bon_gia_nhiet_2',
            // 'time_chay_van_dien_tu_ba_nga',
            // 'time_chay_van_dien_tu_mot_chieu',
            // 'du_phong',

        ['class' => 'yii\grid\ActionColumn'],
        ],
        ]); ?>
        <?php 
    Pjax::end();
    ?>
</div>
