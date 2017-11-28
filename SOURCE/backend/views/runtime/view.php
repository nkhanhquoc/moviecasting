<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\RuntimeStatistics */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('backend', 'Runtime Statistics'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="runtime-statistics-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
        'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
        'method' => 'post',
        ],
        ]) ?>
    </p>

    <?= DetailView::widget([
    'model' => $model,
    'attributes' => [
                'id',
            'module_id',
            'time_bom_doi_luu_1',
            'time_bom_doi_luu_2',
            'time_chay_bom_cap_nuoc_lanh_1',
            'time_chay_bom_cap_nuoc_lanh_2',
            'time_chay_bom_hoi_duong_ong_1',
            'time_chay_bom_hoi_duong_ong_2',
            'time_chay_bom_tang_ap_1',
            'time_chay_bom_tang_ap_2',
            'time_chay_bom_nhiet_bon_gia_nhiet_1',
            'time_chay_bom_nhiet_bon_gia_nhiet_2',
            'time_chay_van_dien_tu_ba_nga',
            'time_chay_van_dien_tu_mot_chieu',
            'du_phong',
    ],
    ]) ?>
    <p>
        <?= Html::a(Yii::t('backend', 'Update'), ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a(Yii::t('backend', 'Delete'), ['delete', 'id' => $model->id], [
        'class' => 'btn btn-danger',
        'data' => [
        'confirm' => Yii::t('backend', 'Are you sure you want to delete this item?'),
        'method' => 'post',
        ],
        ]) ?>
    </p>
</div>
