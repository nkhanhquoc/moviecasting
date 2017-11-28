<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use backend\widgets\AwsGridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\DistricSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('backend', 'Districs');
$this->params['breadcrumbs'][] = $this->title;
$provincial = backend\models\Provincial::getAll();
$listUsers = backend\models\User::getAllUser();
?>
<div class="distric-index">
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?=
        Html::a(Yii::t('backend', 'Create {modelClass}', [
                    'modelClass' => 'Distric',
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
            'code',
            'name',
            [
                'label' => 'Tỉnh/Thành phố',
                'attribute' => 'provincial_id',
                'content' => function ($data) {
                    return Html::encode($data->provincial->name);
                },
                'filter' => $provincial
            ],
//            'updated_by',
//            'updated_at',
            [
                'label' => 'Người tạo',
                'attribute' => 'created_by',
                'content' => function ($data) {
                    return Html::encode($data->createdBy->username);
                },
                'filter' => $listUsers
            ],
            'created_at',
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]);
    ?>
    <?php
    Pjax::end();
    ?>
</div>
