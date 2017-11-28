<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\widgets\AwsGridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\ModuleStatusSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Module Statuses');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="module-status-index">
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    
    <p>
        <?= Html::a(Yii::t('backend', 'Create {modelClass}', [
    'modelClass' => 'Module Status',
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
            'bom_doi_luu_1',
            'bom_doi_luu_2',
            'bom_cap_nuoc_lanh_1',
            // 'bom_cap_nuoc_lanh_2',
            // 'bom_hoi_duong_ong_1',
            // 'bom_hoi_duong_ong_2',
            // 'bom_tang_ap_1',
            // 'bom_tang_ap_2',
            // 'bom_ha_nhiet_bon_gia_nhiet_1',
            // 'bom_ha_nhiet_bon_gia_nhiet_2',
            // 'van_dien_tu_ba_nga',
            // 'van_dien_tu_mot_chieu',

        ['class' => 'yii\grid\ActionColumn'],
        ],
        ]); ?>
        <?php 
    Pjax::end();
    ?>
</div>
